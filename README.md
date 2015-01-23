ContactBundle
=============

Petit bundle qui ajoute une page de contact a votre site web

#Installation

ajouter ```new Rudak\ContactBundle\RudakContactBundle(),``` dans le kernel

##Routing

ajouter dans routing.yml

        rudak_contact:
            resource: "@RudakContactBundle/Resources/config/routing.yml"
            prefix:   /

ajouter la config qui va bien dans app/config.yml

        rudak_contact:
            email_from: email-from@email.fr
            email_to : email-to@email.fr