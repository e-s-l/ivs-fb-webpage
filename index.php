<?php


  ///////////
  // Debug //
  ///////////

  /**
  * @var bool $debug Enable/disable debugging mode for details.
  */
  $debug = TRUE;

  if ($debug) {
      error_reporting(E_ALL);
      ini_set('display_errors', 'On');
  }

  ////////////
  // Import //
  ////////////

  require_once 'configuration.php';
  require_once 'functions.php';

  /////////////
  // Connect //
  /////////////

  try {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

  } catch (Exception $e) {
      die("<pre> Error: " . $e->getMessage() . "</pre>");
  }

  ///////////
  // Query //
  ///////////

  // if all-data checkbox is not checked, then apply filtering
  $showFull = isset($_GET['showFull']) && $_GET['showFull'] === '1';
  $defaultColumns = ['ExpID', 'Date', 'Performance', 'Total_Obs','W_RMS_del','Detect_Rate_X'];

  try {
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Fetch all tables from the database
    $tables = [];
    
    $result = $conn->query("SHOW TABLES");

    if ($result) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
    } else {
        throw new Exception("Failed to fetch tables: " . $conn->error);
    }

    $selectedTable = $_GET['table'] ?? $tables[0];
    // $selectedExperiment = $_GET['experiment'] ?? null;

    // Fetch data from the selected table (site)
    $columns = [];
    $rows = [];
    $result = $conn->query("SELECT * FROM `$selectedTable` order by date desc");
    if ($result) {

        $columns = array_keys($result->fetch_assoc() ?? []);
        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {

          if (!$showFull) {
            $row = array_filter(
              $row,
              fn($key) => in_array($key, $defaultColumns),
              ARRAY_FILTER_USE_KEY
              );
          }
        
          $rows[] = $row;
        }

        if (!$showFull) {
          $columns = array_intersect($columns, $defaultColumns);
        }

    } else {
        throw new Exception("Failed to fetch data from $selectedTable: " . $conn->error);
    }
    
  } catch (Exception $e) {
    die("<pre> Error: " . $e->getMessage() . "</pre>");
  }

  include('index.view.php');
  
  $conn->close();
?>
