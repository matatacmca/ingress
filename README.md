# Ingress

A collection of tools for the game Ingress

## Prequisites

- LAMP or WAMP Server (mysql is not a requirement)

- PHP curl

- an Ingress account [start using Ingress](https://ingress.com)

## Installation

1. Clone this Repository to a folder in your webserver using the below command

        git clone https://github.com/matatacmca/ingress.git

2. Navigate into the newly created ingress folder and edit the file 'accountDetails.json.template'
    
    2.1 OPTION A - Manual configuration
    
    2.1.1 Using Chrome, navigate to the [Ingress Intel website](https://intel.ingress.com), and sign in
    
    2.1.2 Once Signed in Open developer Options `ctrl` + `shift` + `i` and open the network tab
    
    2.1.3 you will see a bunch of network requests running, When you see 'getEntities', click it
    
    2.1.4 A side menu wil open up showing you details  of the request, the first thing you want to copy is the 'COOKIE' in the 'request Headers' Section
    
    2.1.5 Paste the Cookie into the file you are editing in the 'cookie' attribute (you may need to use escape characters by editing any '"' into '\"')
    
    2.1.6 Next copy the 'x-csrftoken' token from the Request Headers and paste it in the file you are editing in the 'xcsrftoken' attribute
    
    2.1.7 Next copy the attribute next to 'v' in the Request Payload Section and paste it in the file you are editing in the 'verifier' attribute
    
    2.1.8 The file should look like the following
        
        {
          "cookie" : "csrftoken=susdfufiusyfiusdhfusdyfiudsyfs; ingress.intelmap.lat=-25.86820343042192; ingress.intelmap.lng=29.244670365296773; ingress.intelmap.zoom=15; SACSID=~cjicjsicdijcsicisjcjs-kjhdgfcoidhsvfisdonhihfdsugvodisxiahpowe87948yrnhisd-7984798374hjsgcscusy98w-u8erfu9cs80yo489703r98wcb0e98-74098754309r8cnf0798e7wr04398w7fb-8475280734c8h9f7aosifuydgvyjdgskcfiuywe98r7-9437r0che9f87er0f98w7crf0w89ufejpoifhiughi-76097t3098fhr7eg09er8j798hdbvn9; sessionid=\"97409vt7h9e8jv908rejgu098rgju908rtgju098ruvn0ds9hcx8ucyher8h9s7ryf09erw87t9804728950734r89cjefoiudynvsc09we8rter9-87f08e:1hLA6k:fyFP3Qtg92gjtTv1Q5hxCslP5h4\"",
          "verifier":"e183d9hfudsys9fds987d98s798s7se0e9a4257bf",
          "xcsrftoken":"98r7c98fje9ruf9eujfieuiuerifnueroivueo",
          "mapsAPIKey":"",
          "autoUpdateSecret":""
        }
    2.1.9 Save the file as 'accountDetails.json'  (take note, Should any of the scripts fail to execute, you will need to update this config file with new data)
        
    2.2 OPTION B - Automatic updates via The [Ingress Intel Cookie Monster extension for Google Chrome (Extension is still Pending Review)]()
    
    2.2.1 Configure a secret key in the 'autoUpdateSecret' attribute. the file should look as follows
    
        {
            "cookie" : "",
            "verifier":"",
            "xcsrftoken":"",
            "mapsAPIKey":"",
            "autoUpdateSecret":"1234567890"
        }
    
    2.2.2 Save the file as 'accountDetails.json'
    
    2.2.3 Install the [Ingress Intel Cookie Monster extension for Google Chrome (Extension is still Pending Review)]()
    
    2.2.4 Click on the extension icon
    
    2.2.5 On the page that opens (GUI improvement to come soon), enter your webserver URL that navigates to the Ingress Tools Index page ([https://eme-hosted.co.za/ingress](https://eme-hosted.co.za/ingress)), and the same server secret you created in step 2.2.1 then click Test Connection. If your connection is successful, click on save
    
    2.2.6 Navigate to the [Ingress Intel Website](https://intel.ingress.com) and the Extension should automatically configure the settings for you
  
3. If you plan on using the Ingress Portal Density Map you will need to [Set up a google maps API Key using this article](https://developers.google.com/maps/documentation/javascript/get-api-key). once you have an API key, you will need to edit the 'accountDetails.json' file and add your API key to the configuration
  
    3.1 The file should look like the following
  
        {
          "cookie" : "csrftoken=susdfufiusyfiusdhfusdyfiudsyfs; ingress.intelmap.lat=-25.86820343042192; ingress.intelmap.lng=29.244670365296773; ingress.intelmap.zoom=15; SACSID=~cjicjsicdijcsicisjcjs-kjhdgfcoidhsvfisdonhihfdsugvodisxiahpowe87948yrnhisd-7984798374hjsgcscusy98w-u8erfu9cs80yo489703r98wcb0e98-74098754309r8cnf0798e7wr04398w7fb-8475280734c8h9f7aosifuydgvyjdgskcfiuywe98r7-9437r0che9f87er0f98w7crf0w89ufejpoifhiughi-76097t3098fhr7eg09er8j798hdbvn9; sessionid=\"97409vt7h9e8jv908rejgu098rgju908rtgju098ruvn0ds9hcx8ucyher8h9s7ryf09erw87t9804728950734r89cjefoiudynvsc09we8rter9-87f08e:1hLA6k:fyFP3Qtg92gjtTv1Q5hxCslP5h4\"",
          "verifier":"e183d9hfudsys9fds987d98s798s7se0e9a4257bf",
          "xcsrftoken":"98r7c98fje9ruf9eujfieuiuerifnueroivueo",
          "mapsAPIKey":"fghjknbgvftyujkoijuhgftryghbvgyu",
          "autoUpdateSecret":"123456789"
        }
    
    3.2 Save the file as 'accountDetails.json'
 
4. Due to massive bandwidth usage, you will manually need to update the data file for the portal Density Map by running

        php update.php

5. Once the update.php file has completed executing, navigate to the index page for the ingress tools, and select the neccessary tools from there



