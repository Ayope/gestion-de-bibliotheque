7 October 2021
                                                  Apache Lounge Distribution

                                                    Apache 2.4.51 win64 VS16

Announcement & Changelog: https://www.apachelounge.com/download/

License Information: https://www.apachelounge.com/contact.html

Build with Visual Studio® 2019 (VS16) x64


Minimum system required
-----------------------

Windows 7 SP1  
Windows 8 / 8.1
Windows 10
Windows 11
Windows Server 2022
Windows Server 2019
Windows Server 2016
Windows Server 2008 R2 SP1 
Windows Server 2012 / R2
Windows Vista SP2

Install
-------
   
  You must first install the Visual C++ Redistributable for Visual Studio 2015-2019 x64. 
  Download and Install, if you have not done so already, see:

   https://www.apachelounge.com/download/

  Unzip the Apache24 folder to c:/Apache24 (that is the ServerRoot in the config).
  The default folder for your your webpages is DocumentRoot "c:/Apache24/htdocs"

  When you unzip to an other location: 
  change Define SRVROOT "c:/Apache24"  in httpd.conf, for example to "E:/Apache24"

Run and test
------------

  Open a command prompt window and cd to the c:\Apache24\bin folder.
  
  To Start Apache in the command prompt type:
  
    >httpd.exe
  
  Press Enter. If there are any errors it will tell you. 
  Warnings will not stop Apache from working, they do need to be addressed none the less. 
  If there are no errors the cursor will sit and blink on the next line. 
  
  You can test your installation by opening up your Browser and typing in the address:
  
     http://localhost
  
  You can shut down Apache by pressing Ctrl+C (It may take a few seconds)
  
  To install as a service. Open command prompt as Administrator and type:
  
    >httpd.exe -k install

  You can start/stop the service with the command:

  >services.msc
  
  
  To see all Command line options:
  
    >httpd -h

  
  ApacheMonitor:
  
  Double click ApacheMonitor.exe, or put it in your Startup folder.
  



Upgrading
---------

- Upgrading from 2.2.x see: httpd.apache.org/docs/2.4/upgrading.html
  and see httpd.apache.org/docs/2.4/new_features_2_4.html .

- Updating from 2.3.x
  copy all the files over, except your changed .conf files.



When you have questions or want more info, post in the forum at www.apachelounge.com or mail me.

Enjoy,

Steffen
