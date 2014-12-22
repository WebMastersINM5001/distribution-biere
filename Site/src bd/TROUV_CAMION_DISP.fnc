CREATE OR REPLACE FUNCTION TROUV_CAMION_DISP (noLiv  LIVRAISON.nolivraison%type)
RETURN INTEGER IS

nbCaisse    INTEGER := 0;
dispo       CHAR    :='N';
camion      integer :=0;
nbCommande  INTEGER := 0;
--Déclaration du curseur
CURSOR	lireLigne IS
	SELECT * 
	FROM   CAMION CM;
-- Variable temp est utilise pour mettre les colonnes du curseur 
temp    lireLigne%ROWTYPE;

BEGIN
  nbCaisse := nbCaisseDe24parNoLivraison(noLiv);
  
  --Verifier le premier camion qui est diponible 
  OPEN lireLigne;
    LOOP
      FETCH lireLigne INTO temp;
      EXIT WHEN dispo = 'Y';
          
          dispo := upper(temp.disponible);
          camion := temp.nocamion;
        END LOOP;
        CLOSE lireLigne;
    IF dispo = 'N' THEN
        return -1;
    END IF;
   
  return camion;

END TROUV_CAMION_DISP;
/
