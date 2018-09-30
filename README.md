# FileNamer-VichUploader

In Symfony 4

Rename file being uploaded with the user ID, -uniqid and extension. 
Also, this service remove if it have a previous files with a different extension (jpeg, png, jpg).

FileNamer is a service.

Config in vich_uploader.yaml for namer =>
namer : 
    service : App\Service\FileNamer
    
Config in services.yaml, add =>
App\Service\FileNamer:   
        public: true
