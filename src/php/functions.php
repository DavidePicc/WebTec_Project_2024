<?php

namespace functions;
class functions{
    private const HOST_DB = "localhost";
    private const USERNAME ="root";
    private const PASSWORD ="";
    private const DATABASE_NAME ="sitosandra";

    private $connection;

    public function openDBConnection(){
        $this -> connection = mysqli_connect(
            self::HOST_DB,
            
            self::USERNAME,
            self::PASSWORD,
            self::DATABASE_NAME
        );
        $this -> connection -> set_charset("utf8");
        return mysqli_connect_errno()==0;
    }

    public function getQuadri(){
        $query = "SELECT * FROM quadri ORDER BY data DESC";
        $queryResult = mysqli_query($this -> connection, $query) or die("errore di connessione" .mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult)!=0){
            $result=array();
            while($row = mysqli_fetch_assoc($queryResult)){
                $result[]=$row; 
            }
            $queryResult ->free(); 
            return $result;
        }else{
            return null;
        }
    }

    public function getCarta(){
        $query = "SELECT * FROM carta ORDER BY data DESC";
        $queryResult = mysqli_query($this -> connection, $query) or die("errore di connessione" .mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult)!=0){
            $result=array();
            while($row = mysqli_fetch_assoc($queryResult)){
                $result[]=$row; 
            }
            $queryResult ->free(); 
            return $result;
        }else{
            return null;
        }
    }

    //Funzione per reperire tutte le informazioni su una singola opera (sia quadro che carta)
    public function getOpera($tipoOpera, $idOpera){
        if ($tipoOpera == "quadro") {
            $query = "SELECT * FROM quadri WHERE titolo = ?";
        } elseif ($tipoOpera == "carta") {
            $query = "SELECT * FROM carta WHERE path = ?";
        } else {
            return null;
        }
    
        $stmt = $this->connection->prepare($query);
        
        if ($stmt === false) {
            // Gestione degli errori durante la preparazione della query
            echo("Errore nella preparazione della query: " . $this->connection->error);
        }
    
        $stmt->bind_param("s", $idOpera);
    
        // Esecuzione della query
        if (!$stmt->execute()) {
            // Gestione degli errori durante l'esecuzione della query
            echo("Errore nell'esecuzione della query: " . $stmt->error);
        }
    
        // Ottenere il risultato della query
        $result = $stmt->get_result();
    
        // Estrai i dati dal risultato
        $row = $result->fetch_assoc();
    
        // Chiusura del prepared statement
        $stmt->close();
    
        return $row;
    }
    

    public function modificaOpera($tipoOpera, $idOpera, $titolo, $percorso, $tecnica, $data, $descrizione, $proprietario = null, $altezza = null, $larghezza = null) {
        $stmt = null;
    
        if ($tipoOpera == "quadro") {
            $query = "UPDATE quadri 
                        SET titolo=?, altezza=?, larghezza=?, tecnica=?, data=?, proprietario=?, path=?, descrizione=?
                        WHERE titolo = ?";

            $stmt = ($this->connection)->prepare($query);
            if ($stmt === false) {
                die("Errore di preparazione della query: " . mysqli_error($this->connection));
            }

            $stmt->bind_param("siisissss", $titolo, $altezza, $larghezza, $tecnica, $data, $proprietario, $percorso, $descrizione, $idOpera);

            // Esecuzione della query
            if (!$stmt->execute())
                echo "Errore durante l'inserimento dei dati: " . $stmt->error;

            // Chiusura della connessione e della prepared statement
            $stmt->close();

        } else if ($tipoOpera == "carta") {
            $query = "UPDATE carta 
                        SET titolo=?, tecnica=?, data=?, path=?, descrizione=?
                        WHERE path = ?";
            $stmt = ($this->connection)->prepare($query);
            if ($stmt === false) {
                die("Errore di preparazione della query: " . mysqli_error($this->connection));
            }

            $stmt->bind_param("ssisss", $titolo, $tecnica, $data, $percorso, $descrizione, $idOpera);

            // Esecuzione della query
            if (!$stmt->execute())
                echo "Errore durante l'inserimento dei dati: " . $stmt->error;

            // Chiusura della connessione e della prepared statement
            $stmt->close();
        } else {
            return null;
        }
    }
    

    public function eliminaOpera($tipoOpera, $idOpera){
        if ($tipoOpera == "quadro") { // Quadro
            $query = "DELETE FROM quadri WHERE titolo = '$idOpera'";
        } else if ($tipoOpera == "carta") { // Carta
            $query = "DELETE FROM carta WHERE path = '$idOpera'";
        } else {
            return null;
        }
    
        mysqli_query($this->connection, $query) or die("errore di connessione" . mysqli_error($this->connection));
    }
    
    public function closeConnection(){
        mysqli_close($this ->connection);
    }
    
    
    //funzione form
    public function addMessage($nome, $cognome, $telefono, $testoLibero) {
        $query = "INSERT INTO contatti (nome, cognome, telefono, testo_libero) VALUES ('$nome', '$cognome', '$telefono', '$testoLibero')";

        return mysqli_query($this->connection, $query);
    }
    
    //funzione opera   
    public function addOpera($titolo, $tecnica, $altezza, $larghezza, $anno, $proprietario, $descrizione, $path){
        $query = "INSERT INTO quadri (titolo, tecnica, altezza, larghezza, data, proprietario, descrizione, path) VALUES ('$titolo', '$tecnica', '$altezza', '$larghezza', '$anno', '$proprietario', '$descrizione', '$path')";

        return mysqli_query($this->connection, $query);
    }

    //funzione opera
    public function addCarta($titolo, $tecnica, $anno, $descrizione, $path){
        $query = "INSERT INTO carta (titolo, tecnica, data, descrizione, path) VALUES ('$titolo', '$tecnica', '$anno', '$descrizione', '$path')";

        return mysqli_query($this->connection, $query);
    }

    //funzione check esistenza opera
    public function checkOpera($path){
        $query = "SELECT * FROM quadri WHERE path = '$path'";
        $result = mysqli_query($this->connection, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            
            return true;
        }
        return false;
    }
    
    //funzione check esistenza carta
    public function checkCarta($path){
        $query = "SELECT * FROM carta WHERE path = '$path'";
        $result = mysqli_query($this->connection, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            
            return true;
        }
        return false;
    }    

    
    public function prenotaOpera($user, $quadro, $messaggio){
        $quadro = urldecode($quadro);

        $query = "INSERT INTO prenotazioni(user_id, opera_id, messaggio) VALUES (?, ?, ?)";
    
        $stmt = $this->connection->prepare($query);
        
        if ($stmt === false) {
            // Gestione degli errori durante la preparazione della query
            echo("Errore nella preparazione della query: " . $this->connection->error);
            return false; // Aggiunto per interrompere l'esecuzione in caso di errore
        }
    
        // Modificato il tipo di bind_param da "sss" a "iss" assumendo che user_id e opera_id siano di tipo intero
        $stmt->bind_param("sss", $user, $quadro, $messaggio);
        
        // Esecuzione della query
        if (!$stmt->execute()) {
            // Gestione degli errori durante l'esecuzione della query
            echo("Errore nell'esecuzione della query: " . $stmt->error);
            $stmt->close(); // Aggiunto per chiudere il prepared statement in caso di errore
            return false; // Aggiunto per interrompere l'esecuzione in caso di errore
        }
    
        // Chiusura del prepared statement
        $stmt->close();
    
        return true; // Aggiunto per indicare che l'operazione è stata eseguita con successo
    }

    public function getPrenotazioni($user=null){
        if($user == null)
            $query = "SELECT * FROM prenotazioni";
        else
            $query = "SELECT * FROM prenotazioni WHERE user_id='$user'";
        $queryResult = mysqli_query($this -> connection, $query) or die("errore di connessione" .mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult)!=0){
            $result=array();
            while($row = mysqli_fetch_assoc($queryResult)){
                $result[]=$row; 
            }
            $queryResult ->free(); 
            return $result;
        }else{
            return null;
        }
    }

    public function getMessaggi(){
        $query = "SELECT * FROM contatti";
        $queryResult = mysqli_query($this -> connection, $query) or die("errore di connessione" .mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult)!=0){
            $result=array();
            while($row = mysqli_fetch_assoc($queryResult)){
                $result[]=$row; 
            }
            $queryResult ->free(); 
            return $result;
        }else{
            return null;
        }
    }

    function pulisciInput($value) {
        $value = trim($value); 
        $value = strip_tags($value); 
        $value = htmlentities($value);
        return $value;
    }

    function duplicaApostrofi($input) {
        // Verifica se l'input è una stringa
        if (is_string($input)) {
            // Duplica gli apostrofi nella stringa
            $output = str_replace("'", "''", $input);
            return $output;
        } else {
            // Se l'input non è una stringa, restituisci l'input senza modificarlo
            return $input;
        }
    }
}