@echo off
@rem curl -v http://localhost/agua/index_dev.php/registro -d '{"identificador":"cubo123"}' -H 'Content-Type: application/json'

cls
curl -v -X POST -H "Content-Type:application/json" -H "Accept:application/json" http://localhost/agua/index_dev.php/registro -d "{"node":{"name":"foo","ip_address":"10.0.1.120"}}"