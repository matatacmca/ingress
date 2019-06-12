# Ingress

A collection of tools for the game Ingress

## Prequisites

- LAMP or WAMP Server (mysql is not a requirement)

- PHP curl

- an Ingress account

- The [Ingress Intel Cookie Monster extension for Google Chrome]()

## Installation

1. Clone this Repository to a folder in your webserver using the below command

    git clone https://github.com/matatacmca/ingress.git

2. Navigate into the newly created ingress folder and edit the file 'accountDetails.json.template'

3. Using Chrome, navigate to the intel website, 'https://intel.ingress.com' and sign in

  3.1 Once Signed in Open developer Options `ctrl` + `shift` + `i` and open the network tab
  
  3.2 you will see a bunch of network requests running, When you see 'getEntities', click it
  
  3.3 a side menu wil open up showing you details  of the request, the first thing you want to copy is the 'COOKIE' in the 'request Headers' Section
  
  3.4 Paste the Cookie into the file you are editing in the 'cookie' attribute (you may need to use escape characters by editing any '"' into '\"')
  
  3.5 Next copy the 'x-csrftoken' token from the Request Headers and paste it in the file you are editing in the 'xcsrftoken' attribute
  
  3.6 Next copy the attribute next to 'v' in the Request Payload Section and paste it in the file you are editing in the 'verifier' attribute
  
  3.7 [Set up a google maps API Key using this article](https://developers.google.com/maps/documentation/javascript/get-api-key) and paste the api key in the 'mapsAPIKey' attribute
  
  3.8 The file should look like the following
  
    {
      "cookie" : "csrftoken=susdfufiusyfiusdhfusdyfiudsyfs; ingress.intelmap.lat=-25.86820343042192; ingress.intelmap.lng=29.244670365296773; ingress.intelmap.zoom=15; SACSID=~cjicjsicdijcsicisjcjs-kjhdgfcoidhsvfisdonhihfdsugvodisxiahpowe87948yrnhisd-7984798374hjsgcscusy98w-u8erfu9cs80yo489703r98wcb0e98-74098754309r8cnf0798e7wr04398w7fb-8475280734c8h9f7aosifuydgvyjdgskcfiuywe98r7-9437r0che9f87er0f98w7crf0w89ufejpoifhiughi-76097t3098fhr7eg09er8j798hdbvn9; sessionid=\"97409vt7h9e8jv908rejgu098rgju908rtgju098ruvn0ds9hcx8ucyher8h9s7ryf09erw87t9804728950734r89cjefoiudynvsc09we8rter9-87f08e:1hLA6k:fyFP3Qtg92gjtTv1Q5hxCslP5h4\"",
      "verifier":"e183d9hfudsys9fds987d98s798s7se0e9a4257bf",
      "xcsrftoken":"98r7c98fje9ruf9eujfieuiuerifnueroivueo",
      "mapsAPIKey":"fghjknbgvftyujkoijuhgftryghbvgyu"
    }
    
  3.9 Save the file as accountDetails.json (take note, Should any of the scripts fail to execute, you will need to update this config file with new data)
 
4. run the update.php file

        php update.php

5. Once the update.php file has completed executing, navigate to map.php in a web browser (You can use '?owner=' to toggle which portals you want to display, 'n','e' or 'r' for Neutral, Enlightened or Resistance respectively)



