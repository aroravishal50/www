<?php
require_once __DIR__ . '/../../vendor/autoload.php';

# Imports the Google Cloud client library
use Google\Cloud\BigQuery\BigQueryClient;

function sendViaBigQuery($query)
{
    # Your Google Cloud Platform project ID
    //$projectId = 'burnished-data-183409';

    # Instantiates a client
    $bigquery = new BigQueryClient([
        'projectId' => getConfig()["projectId"]
    ]);
    # [START run_query]
    
    $queryJobConfig = $bigquery->query($query)
        ->parameters([
            'date' => $bigquery->timestamp(new \DateTime('1980-01-01 12:15:00Z')),
            'message' => 'A commit message.'
        ]);
    $queryResults = $bigquery->runQuery($queryJobConfig);
    # [END run_query]
    return $queryResults;
}
