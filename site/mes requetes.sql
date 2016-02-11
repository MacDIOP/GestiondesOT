----------------------Insertion D'agents------------------------
Insert into Agent (Matricule,PrenomAgent,NomAgent)
           Values 
		   ("540217","Junior","Seck"),
		   ("578897","talla","yoro"),
		   ("582367","Nestir","Dieng"),
		   ("543657","Secka","Zade"),
		   ("549877","Lopez","Dia"),
		   ("542365","Mamadou","Diop"),
		   ("844785","Merick","Diop"),
		   ("342365","Bintou","gaye"),
		   ("742345","Merick","Diop"),
		   ("542963","Miranda","Diop"),
		   ("693656","Danick","Saivet"),
		   ("782365","Berauld","Diallo"),
		   ("985174","Fadel","Sall");		   
------------------------------------------------Requete Insertion journalEquipe------------------------------------
------------------------------------------------Requete Insertion journalEquipe------------------------------------
Insert into journalEquipe (CODEEQUIPE,MATRICULE,DATEFORMATION,IDPILOTE)
								Values	 ("TDX-M01","782365",now(),"1478"),
										 ("TDX-M02","342365",now(),"14785"),
										 ("TDX-M03","742345",now(),"1478"),
										 ("TDX-M04","578897",now(),"14785"),
										 ("TDX-M07","844785",now(),"14785"),
										 ("TDX-M08","542963",now(),"1478");		
------------------------------------------------Requete Insertion journalEquipe------------------------------------
INSERT INTO AFFECTATION (CODEEQUIPE,MATRICULE,dateaffectation)
			VALUES ("TDX-M01",540217,now()),
					("TDX-M02",542365,now()),
					("TDX-M02",542963,now()),
					("TDX-M01",549877,now());										 
------------------------------------------------Requete Selection journalEquipe et chef equipe------------------------------------
Select JournalEquipe.CodeEquipe,Agent.MATRICULE, CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) AS ChefEquipe    
	FROM JournalEquipe INNER JOIN Agent 
		ON JournalEquipe.Matricule = Agent.Matricule; 
------------------------------------------------Requete Selection Affectation Matricule------------------------------------
DELIMITER |
CREATE PROCEDURE AgentsdelEquipe(IN p_NumEquipe varchar(255) ) 
	BEGIN
		Select agent.MATRICULE,NOMAGENT,PRENOMAGENT from agent 
			inner join affectation on agent.MATRICULE = affectation.MATRICULE
				Where affectation.CodeEquipe = p_NumEquipe;
	END|
DELIMITER ;	
					
					
----------------------Requete Connexion------------------------
		            --Requete SQL---
Prepare SelectionUser from 'Select * from utlisateur where iduser= ?;'
execute SelectionUser Using [$_POST["iduser"]];
					--Requete PHP---
$SelectionUser = $bdd->prepare ('SELECT * FROM utilisateur WHERE iduser = :id');
$SelectionUser -> bindValue(':id', $_POST["iduser"], PDO::PARAM_STR);
$SelectionUser ->execute();
$SelectionUser->closeCursor();    
----------------------Requete Concernant les pilotes------------------------	
				  ------Requete Insertion de pilotes-----
$InsertionPilote = $bdd -> prepare ('Insert into pilote (IDPILOTE,NOMPILOTE,PRENOMPILOTE) 
									 Values (:iduser,:nompilote,:prenompilote)');
$InsertionPilote -> execute (array ( 'iduser' => $_POST["iduser"],
									 'nompilote' => $_POST["nom"],
									 'nompilote' => $_POST["prenom"]));	
$InsertionPilote->closeCursor();
----------------------Requete Inscription------------------------
$Inscription = $bdd -> prepare ('Insert into utilisateur (iduser,statut,password,nom,Prenom)
					             Values (:identifiant,:level,:passwd,:nameuser,:prenomuser)');
$Inscription -> execute (array ( 'identifiant' => $_POST[" "],
								 'level' => $_POST[" "],	
								 'passwd' => $_POST[" "],
								 'nameuser' => $_POST[" "],
								 'prenomuser' => $_POST[" "]));
$Inscription->closeCursor();
----------------------Requete Liste des OT------------------------------
				--Requete Liste total des OT--
$ListedesOT = $bdd -> prepare ('Select * from derangement');
$ListedesOT -> execute();
$ListedesOT -> closeCursor();
			--Requete OT concernant un numero--
$OTspecifique = $bdd -> prepare ('select * from derangement where ND = :numdrgt');
$OTspecifique -> execute( array('numdrgt' => $_GET[""]));
$OTspecifique -> closeCursor();
----------------------Requete Insertion de derangement et d'Abonnement------------------------------
select * from derangement where Dateorientation < now() order by Dateorientation DESC limit 1;
Select Count(CodeEquipe) from derangement where ETATOT ="Initiale";

--------------------------Requete Insertion d'abonnement(TRIGGGER)--------------
DELIMITER |
CREATE TRIGGER Bef_Ins_abonnement BEFORE INSERT 
ON abonnement For each row
	Begin 
		insert into ordretravail (numot,codeequipe,etatot,Prioritedrgt,Debit,NomClient,NumeroClient,DateOrientation)
						  VALUES (New.numot,New.CodeEquipe,New.EtatOT,New.Prioritedrgt,New.Debit,New.NomClient,New.NumeroClient,New.DateOrientation);
	END |
DELIMITER ;	
---------------------------------------Requete Insertion de derangement(TRIGGGER)-----------------------------
DELIMITER |
CREATE TRIGGER Bef_Ins_drgt BEFORE INSERT 
ON derangement For each row
	Begin 
		insert into ordretravail (codeequipe,etatot,Debit,NomClient,NumeroClient,DateOrientation)
						  VALUES (New.CodeEquipe,New.EtatOT,New.Debit,New.NomClient,New.NumeroClient,New.DateOrientation);
	END |
DELIMITER ;
-----------------------------------------------Requete Insertion abonnement------------------------------------
insert into Abonnement (NDA,CODEEQUIPE,etatot,Prioritedrgt,Debit,NomClient,NumeroClient,DateOrientation)
						  VALUES (338513423,"TDX-M1","Initiale","Commerciale","Haut Debit","Diabel",772531478,now());

						  
$derangement = $bdd -> prepare ('insert into derangement (ND,CODEEQUIPE,etatot,Prioritedrgt,Debit,NomClient,NumeroClient,DateOrientation)
						  VALUES(:drgt,:codeteam,"Initiale":type,:debit,:client,:numclient,now())');
		$derangement -> execute (array ( 'drgt' = $_POST[""],
										 'codeteam' = $_POST[""],
										 'type' = $_POST[""],
										 'debit' = $_POST[""], 	
										 'client' = $_POST[""],
										 'numclient' = $_POST[""]));
		$derangement -> closeCursor;								 
						  
						  
						  
insert into Ordretravail (CODEEQUIPE,etatot,Prioritedrgt,Debit,NomClient,NumeroClient,DateOrientation)
						  VALUES ("TDX-M25","Initiale","Commerciale","Haut Debit","Sara Diane",772541478,now());

<!--==============================Connexion a la base et selection de l'ot recherche================================-->
<?php 
try
{
$bdd = new PDO('mysql:host=localhost;dbname=bdfinal', 'root', '');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}						  
		$OtRechercher = $bdd->prepare ('SELECT * FROM derangement WHERE ND = :NUM');
$OtRechercher -> bindValue(':NUM', $_GET["Search"], PDO::PARAM_STR);
$OtRechercher ->execute();
 
    $donnees = $OtRechercher -> fetch()
$OtRechercher->closeCursor();	
?>						  
-----------------------------------------------Requete Insertion Pilote (TRIGGER)------------------------------------
DELIMITER |
Create trigger aft_ins_utilisateur After INSERT 
ON utilisateur For each row	
		Begin
			if NEW.statut = "Pilote"
				then 
					insert into Pilote (IDPILOTE,NOMPILOTE,PRENOMPILOTE) 
								 VALUES (New.iduser,New.nom,New.Prenom);
				---Else 
					---create user "NEW.iduser"@"localhost" identified by "NEW.password";				 
			END if;
		END |	
DELIMITER ;
------------------------------------------------Requete Insertion Pilote------------------------------------
INSERT INTO utilisateur (iduser,statut,password,nom,prenom)
			   Values   ("pilo145","pilote","empire","Yazz","Boddiez");
------------------------------------------------Requete Insertion JournalEquipe------------------------------------
$NewEquipe = $bdd -> prepare ('Insert into journalEquipe (CODEEQUIPE,MATRICULE,DATEFORMATION,IDPILOTE)
								Values	 (:Codeteam,:IdAgent,now(),:Idpilote)');
$NewEquipe -> execute (array (
								'Codeteam' => $_POST[" "],
								'IdAagent' => $_POST[" "],
								'Idpilote' => $_POST[" "]));
$NewEquipe->closeCursor();								
------------------------------------------------Requete Insertion Affectation------------------------------------
$Affecter = $bdd -> prepare ('Insert into Affectation (CODEEQUIPE,MATRICULE,DATEAFFECTATION)
								Values	 (:team,:Agent,now()');
$Affecter -> execute (array (
								'team' => $_POST[" "],
								'Agent' => $_POST[" "]);
$Affecter->closeCursor();			   
------------------------------------------------Requete Insertion Releve------------------------------------
$Relever = $bdd ->	prepare('Insert into releve (NUMERORELEVE,ND,DATERELEVE)
							Values (:numrelve,:numdrgt,now())');
$Relever -> execute (array ( 'numrelve' => $_POST[" "],
							 'numdrgt' => $_POST[" "]));	
$Relever -> closeCursor();										
------------------------------------------------Requete Insertion Releve (TRIGGER)------------------------------------
DELIMITER |
Create trigger aft_ins_relve AFTER INSERT 
     ON Releve For each row
		BEGIN
			Update derangement SET ETATOT= "REALISEE" where ND = NEW.ND;
		END|
DELIMITER ;			   
------------------------------------------------Requete Insertion Decharge (TRIGGER)------------------------------------
DELIMITER |
Create trigger aft_ins_decharge AFTER INSERT 
     ON decharge For each row
		BEGIN
			Update Abonnement SET ETATOT= "REALISEE" where NDA = NEW.NDA;
		END|
DELIMITER ;				   
------------------------------------------------Requete Insertion Decharge ------------------------------------
$Decharger = $bdd ->	prepare('Insert into Decharge (NUMDECHARGE,NDA,DATEDECHARGE)
							Values (:decharge,:numdmde,now())');
$Decharger -> execute (array ( 'decharge' => $_POST[" "],
							 'numdmde' => $_POST[" "]));	
$Decharger -> closeCursor();

Insert into decharge (NUMDECHARGE,NDA,DATEDECHARGE)
			VALUES (541,33854214,now());
------------------------------------------------Requete Insertion COCC------------------------------------
DROP PROCEDURE ImporterCOCC;
DELIMITER :
	CREATE PROCEDURE ImporterCOCC
		(IN P_ND decimal(10,0), IN P_CE varchar(255), IN P_Dbit varchar(255), IN P_NumClient decimal(10,0),
				IN P_NomClient varchar(255), IN P_DateOri datetime, IN P_SR varchar(255), IN P_PRD varchar(255),IN P_PRS varchar(255),
					IN P_DateEssai datetime, IN P_DatePlan datetime, IN P_DateSignal datetime,IN P_CommentEssai varchar(255),IN P_CommentSignal varchar(255),
					IN P_ETATOT varchar(255),IN Defaut varchar(255), OUT P_msg varchar(255))
		BEGIN		
				DECLARE V_numdrgt DECIMAL(10,0); 
				DECLARE V_codesr varchar(255);
				DECLARE V_DateSignal datetime;
				DECLARE V_DateEssai datetime;
				
				DECLARE Unicite_contraint CONDITION FOR 1062;
				DECLARE CodeSr_Invalide CONDITION FOR 1452;

				DECLARE EXIT HANDLER FOR Unicite_contraint	
					BEGIN
						SET V_numdrgt = P_ND;
						Select 'Numero deja Oriente' into P_msg;
					END;
			DECLARE EXIT HANDLER FOR CodeSr_Invalide 
				BEGIN
					Select 'Sous Repartiteur Inexistant' into P_msg;
				END;
			DECLARE EXIT HANDLER FOR SQLEXCEPTION 
				BEGIN
					Select 'Erreur Inconnue : Contacter votre administrateur' into P_msg;
				END;
			
			SET V_DateSignal = STR_TO_DATE(P_DateSignal,"%d/%m/%Y");
			SET V_DateEssai = STR_TO_DATE(P_DateEssai,"%d/%m/%Y");
			insert into derangement 
				(ND,CodeEquipe,codesr,ETATOT,Prioritedrgt,DEBIT,NOMCLIENT,NUMEROCLIENT,DATEORIENTATION,PrioriteSignal,
				   DateSignalisation,DatePlanification,CommentairesSignal,CommentairesEssai,DateEssai)
						VALUES(P_ND,P_CE,P_SR,P_ETATOT,P_PRD,P_Dbit,P_NomClient,P_NumClient,P_DateOri,P_PRS,
								V_DateSignal,P_DatePlan,P_CommentSignal,P_CommentEssai,P_DateEssai) ;
			insert into erreur (erreur) Values (P_msg);
		END :
DELIMITER ;		
		
CALL ImporterCOCC("Y06",338322003,"haut","WANE JEANNETTE SALL",778085040,"SANS","HS","OR","25/09/2015",
		"bgaye// aucune images","26/09/2015","B.SOW//maestro lbe synch ok cl","ABIM","26/09/2015","PATRIC","26/09/2015",@Bh);	



------------------------------------------------Requete Insertion AFFECTATION------------------------------------
DROP PROCEDURE IF EXISTS `INSERTION_AFFECTATIONS`;
DELIMITER :
CREATE PROCEDURE INSERTION_AFFECTATIONS (IN p_Equipe varchar(255) , 
											IN p_Agent varchar(255), 
											IN p_subs varchar(10),
											out p_presence varchar(255), 
											out p_message varchar(255))
BEGIN
		  DECLARE V_NbreAgents INT;
		  DECLARE V_Nomdelagent varchar(255);
		select count(*) from affectation natural join agent where CODEEQUIPE = p_Equipe into V_NbreAgents;  
				-- Check Presence de l agent-----------
		select CONCAT_WS(' ',Agent.PRENOMAGENT,Agent.NOMAGENT) as Agent 
			from affectation natural join agent 
				where affectation.CODEEQUIPE = p_Equipe AND affectation.MATRICULE = p_Agent
			into V_Nomdelagent;
			
		if V_Nomdelagent is null then -- Si l'agent n'est pas dans lequipe-------------
			
			IF p_subs != "NON" then 
				Update affectation Set MATRICULE= p_subs , dateaffectation = now() where CODEEQUIPE=p_Equipe  AND MATRICULE=p_agent;
			END IF;
			IF V_NbreAgents >= 4 then -- Si l equipe est complet
				select "Cette equipe est deja au complet" into p_message;
					ELSE 
						Insert into affectation (CODEEQUIPE,MATRICULE,dateaffectation)
									Values (p_Equipe,p_Agent,now());
					select "L'agent a bien ete affecte" into p_message;				
			END IF;
		ELSE 
			
			select MATRICULE from agent where MATRICULE = p_Agent into p_presence;
			IF p_presence = p_Agent then
				SET p_presence = CONCAT_WS(' ',V_Nomdelagent," est deja dans l'equipe.");
			ELSE
				select "Cet Agent n'existe pas" into p_presence;
			END IF;	
		END IF;					
END :
DELIMITER ;
CALL INSERTION_AFFECTATIONS("TDX-M10","S012","NON",@R,@F);
----------------------Changement d'Agent---------------------
Update affectation Set MATRICULE="S029" , dateaffectation = now() where CODEEQUIPE="TDX-M13"  AND MATRICULE="S009"; 
------------------------------------------------Requete Selection Equipe Join OT------------------------------------
Select JournalEquipe.CODEEQUIPE,JournalEquipe.MATRICULE,CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as ChefEquipe,JournalEquipe.DATEFORMATION,
					 from JournalEquipe NATURAL JOIN Agent;
					 
------------------Selection des Agents Simples----------------------------					 
select agent.MATRICULE, agent.NOMAGENT, agent.PRENOMAGENT
		from agent natural left join JournalEquipe 
			Where JournalEquipe.CodeEquipe IS NULL					 
------------------------------------------------Requete affectation des agents dans les Equipes------------------------------------
select Affectation.CODEEQUIPE,CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as NomAgent, Affectation.dateaffectation 
					from Affectation Natural join Agent
						where Agent.Matricule = "4756321"   -----Agent Specifique---------
							ORDER BY NomAgent DESC;			
---------NOMBRE AFFECTATION--------------------------------------						
Select CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as NomAgent, count(*) as nombreaffection 
		from Affectation natural join Agent 
			where Agent.Matricule = "4756321";
--------------------Agents affectes a une Eqquipe----------------------------		
select CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as NomAgent,Affectation.DateAffectation 
	from Affectation Natural join Agent 
		where CodeEquipe="TDX-M27";	
		
select ND as Otdlagent,derangement.codeEquipe as EquipeRealisatrice,CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as NomAgent
		from derangement 
			Inner Join JournalEquipe 
				On derangement.codeEquipe= JournalEquipe.CodeEquipe
			Inner Join Affectation 
				ON  JournalEquipe.codeEquipe = Affectation.CodeEquipe
			Inner Join Agent
				ON Affectation.Matricule = Agent.Matricule;
		----Where Date(DateOrientation)=Date(DateAffectation);	
		----;
select JournalEquipe.CodeEquipe,CONCAT_WS(' ',Agent.NOMAGENT,Agent.PRENOMAGENT) as NomAgent
		from JournalEquipe 
			Inner Join Affectation 
				ON  JournalEquipe.codeEquipe = Affectation.CodeEquipe
			Inner Join Agent
				ON Affectation.Matricule = Agent.Matricule
					Where Agent.Matricule = "4756321";		
------------------------------------------------Nombre De derangements------------------------------------
Select derangement.CodeEquipe, count(*) as nbres_de_derangements
		from derangement group by derangement.CodeEquipe;
 
------------------------------------------------LOAD DATA INFILE------------------------------------
LOAD DATA LOCAL INFILE 'Agentscsv.csv'
	INTO TABLE agent
		FIELDS TERMINATED BY ';' ENCLOSED BY '"'
		LINES TERMINATED BY '\n'
		IGNORE 1 LINES
	(MATRICULE,NOMAGENT,PRENOMAGENT);	
------------------------------------------------Contrainte chef equipe------------------------------------
Alter table JournalEquipe add constraint const_ChefEquipe UNIQUE (Matricule);

Select Count(*) AS NbLignes from JournalEquipe;

INSERT INTO Lesdates (unedate) Values (DATE_FORMAT("29/10/2015","%Y-%m-%d %H:%i:%s"));



insert into derangement (ND,codesr,DATEORIENTATION,DateEssai)
		VALUES	("3345321","A01","2012-12-02",DATE_FORMAT("12/01/2012","%Y-%m-%d %H:%i:%s"));
						
----------------------------------------------------test de requetes------------------------
INSERT INTO Erreur (erreur) VALUES ('Erreur : trigger ne marche pas');

Insert into pilote (idPilote,NomPilote,PrenomPilote)
			Values (14785,"Mbacke","Dem"),
					(478544,"Saliou","Sall");

Create procedure listedesagents()
  select * from agent;

  Create procedure listedesOT()
  select *from ordre_travail;


  
Alter table Abonnement drop foreign key FK_ABONNEME_DECHARGER_DECHARGE;
Alter table Ordretravail drop foreign key FK_ORDRETRA_REALISER_JOURNALE;
Alter table derangement drop foreign FK_DERANGEM_RELEVER2_RELEVE;
Alter table Abonnement drop foreign key FK_ABONNEME_ETRE2_ORDRETRA;
Alter table Abonnement drop foreign key FK_DERANGEM_ETRE_ORDRETRA;

Alter table Affectation drop foreign key FK_AFFECTAT_AFFECTATI_JOURNALE;
alter table JOURNALEQUIPE
   add constraint FK_JOURNALE_ORIENTER_PILOTE foreign key (IDPILOTE) references PILOTE (IDPILOTE)
      on update cascade
      on delete SET NULL;
	  
	  
Alter table derangement add column PrioriteSignal varchar(255) NULL ;
Alter table derangement add column Prioritedrgt varchar(255) NULL ;
Alter table derangement add column DateSignalisation Datetime NULL ;
Alter table derangement add column Origine varchar(255) NULL ;
Alter table derangement add column DatePlanification Datetime NULL ;
Alter table derangement add column CommentairesSignal varchar(255) NULL ;
Alter table derangement add column CommentairesEssai varchar(255) NULL ;
Alter table derangement add column DateEssai  Datetime  NULL ; 

Alter table derangement add column Defaut varchar(255) NULL ;
Alter table derangement add column Origine varchar(255) NULL ;	
Alter table derangement add column Seg varchar(255) NULL ;

update derangement set CodeEquipe = "TDX-M12" where CodeEquipe = "PATRICK DASYL";
update derangement set CodeEquipe = "TDX-M5" where CodeEquipe = "TDX-ME5";
update derangement set CodeEquipe = "TDX-M3" where CodeEquipe = "TADEX3";
update derangement set CodeEquipe = "TDX-M2" where CodeEquipe = "TDX_M2";
update derangement set CodeEquipe = "TDX-M6" where CodeEquipe = "TDX_M6";
update derangement set CodeEquipe = "TDX-M9" where CodeEquipe = "TDX_9";
update derangement set CodeEquipe = "TDX-M1" where CodeEquipe = "TDX_M1";
update derangement set CodeEquipe = "TDX-M3" where CodeEquipe = "TADEX3";
update derangement set CodeEquipe = "TDX-M2" where CodeEquipe = "TDX_M2";
update derangement set CodeEquipe = "TDX-M6" where CodeEquipe = "TDX_M6";
update derangement set CodeEquipe = "TDX-M9" where CodeEquipe = "TDX_9";
update derangement set CodeEquipe = "TDX-M10" where CodeEquipe = "TDX_10";
update derangement set CodeEquipe = "TDX-M10" where CodeEquipe = "TDX-10";

---1---------------A changer dans la base------------------------------------
Update journalequipe set CODEEQUIPE="TDX-M7" where Matricule="S259";
Update journalequipe set CODEEQUIPE="TDX-M10" where CODEEQUIPE="TDX_10";
insert into agent (Matricule,NOMAGENT,PRENOMAGENT) VALUES ("S000","Premature","Compte");
Update journalequipe set MATRICULE="S239" where CODEEQUIPE="TDX-M13";
Update journalequipe set MATRICULE="S264" where CODEEQUIPE="TDX-M3";
Update journalequipe set MATRICULE="S001" where CODEEQUIPE="TDX-M9";
Update journalequipe set MATRICULE="S000" where CODEEQUIPE="TDX-9";

insert into journalEquipe (CODEEQUIPE,MATRICULE,Idpilote) VALUES ("TDX-M5","S044","0137");

insert into journalEquipe (CODEEQUIPE,MATRICULE,Idpilote) VALUES ("TDX-P5","S274","0137");
insert into journalEquipe (CODEEQUIPE,MATRICULE,Idpilote) VALUES ("TDX-M26","S261","0137");
---------2----------A changer 25 Nov----------------------------------
ALTER TABLE releve ADD COLUMN Initiale varchar(5) NULL;
ALTER TABLE releve ADD COLUMN CommentairesReleve varchar(255) NULL;
insert into journalEquipe (CODEEQUIPE,MATRICULE,Idpilote) VALUES ("TDX-9","S000","0137");
Update journalequipe set MATRICULE="S001" where CODEEQUIPE="TDX-M9";
Update journalequipe set MATRICULE="S000" where CODEEQUIPE="TDX-9";
insert into agent (MATRICULE,NOMAGENT,PRENOMAGENT) VALUES ("S001","Faye","Mbaye");
--------------New tables-----------
create table planningequipe
(
DateValidation Datetime NOT NULL,
NombreOT decimal(2) NOT NULL,
EquipeComplet varchar (10),
constraint PK_planning primary key (DateValidation)   
);
create table plandecharge
(
CODEEQUIPE varchar(255) NOT NULL,
DateValidation Datetime NOT NULL,
constraint PK_plandecharge primary key clustered (CODEEQUIPE,DateValidation)
); 
ALTER TABLE plandecharge ADD CONSTRAINT FK_plandcharg FOREIGN KEY (CODEEQUIPE) references journalequipe(CODEEQUIPE)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT;
ALTER TABLE plandecharge ADD CONSTRAINT FK_plandcharg2 FOREIGN KEY (DateValidation) references planningequipe(DateValidation)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT;	