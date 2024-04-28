<?php

class Database
{
    private function DBConnection() {
        /* Database credentials. Assuming you are running MySQL
        server with default setting (user 'root' with no password) */

        //webserver
        $host = '10.64.18.209';
        $username = 'gen_server';
        $password = 'Geheim01';
        $database = 'it-ausbildung';


        /* Attempt to connect to MySQL database */
        $db_link = mysqli_connect($host, $username, $password, $database);

        // Check connection
        if ($db_link === false) {
            die("Kaput :( " . mysqli_connect_error());
        }
        return $db_link;
    }
    function GetAllPeoples() {
        $db_link = $this->DBConnection();
        $sql = "SELECT * FROM personen ORDER BY Lehrjahr DESC, Nachname ASC";
        $db_erg = mysqli_query($db_link, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($db_erg)) {
            $Data = array(
                "ID" => $row["ID"],
                "FirstName" => $row["Vorname"],
                "LastName" => $row["Nachname"],
                "Year" => $row["Lehrjahr"],
                "ImgSrc" => $row["BildLink"]
            );
            array_push($data, $Data);
        }
        mysqli_close($db_link);
        return $data;
    }
    function GetAllProjects() {
        $db_link = $this->DBConnection();
        $sql = "SELECT * FROM projekte ORDER BY Lehrjahr DESC, ProjekteName ASC";
        $db_erg = mysqli_query($db_link, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($db_erg)) {
            $Data = array(
                "ID" => $row["ProjekteID"],
                "Name" => $row["ProjekteName"],
                "Link" => $row["Link"],
                "Description" => $row["Beschreibung"],
                "Year" => $row["Lehrjahr"],
                "ImgSrc" => $row["BildLink"]
            );
            array_push($data, $Data);
        }
        mysqli_close($db_link);
        return $data;
    }
    function BackendDeletePerson($id) {
        $db_link = $this->DBConnection();

        $result = $db_link->query("SELECT Vorname, Nachname FROM personen WHERE ID = $id");
        if ($result) {
            $row = $result->fetch_assoc();

            $vorname = $row['Vorname'];
            $nachname = $row['Nachname'];
            unlink('C:/inetpub/wwwroot/Ausbildungsseite/IMG/PFP/' . $vorname . $nachname . ".png");
        }

        $sql2 = "DELETE FROM personen WHERE ID = '$id'";
        if ($db_link->query($sql2) === TRUE) {
        }

        mysqli_close($db_link);
    }
    function BackendDelProject($Title) {
        $db_link = $this->DBConnection();

        $sql = "DELETE FROM projekte WHERE ProjekteName = '$Title'";
        if ($db_link->query($sql) === TRUE) {
            unlink('C:/inetpub/wwwroot/Ausbildungsseite/IMG/Projects/' . $Title . ".png");
        }

        mysqli_close($db_link);
    }
    function BackendAddPerson($LastName, $FirstName) {
        $db_link = $this->DBConnection();
        $ImgPath = 'http://10.64.19.16/Ausbildungsseite/IMG/PFP/' . $FirstName . $LastName . '.png';
        $sql = "INSERT INTO personen (Nachname, Vorname, Lehrjahr, BildLink) VALUES ('$LastName', '$FirstName', '2', '$ImgPath')";
        if ($db_link->query($sql) === TRUE) {
        }
        mysqli_close($db_link);
    }
    function BackendPlusOne($id) {
        $db_link = $this->DBConnection();
        $sql = "UPDATE personen SET Lehrjahr = '3' WHERE ID = '$id'";
        if ($db_link->query($sql) === TRUE) {
        }
        mysqli_close($db_link);
    }
    function BackendAddProject($Title, $Year, $Link, $Desc) {
        $db_link = $this->DBConnection();
        $ImgPath = 'http://10.64.19.16/Ausbildungsseite/IMG/Projects/' . $Title . '.png';
        $sql = "INSERT INTO projekte (ProjekteName, Link, Beschreibung, Lehrjahr, BildLink) VALUES ('$Title', '$Link', '$Desc', '$Year', '$ImgPath')";
        if ($db_link->query($sql) === TRUE) {
        }
        mysqli_close($db_link);
    }
}

