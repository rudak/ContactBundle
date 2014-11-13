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
