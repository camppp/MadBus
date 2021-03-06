# MadBus
lyuxuan.com/MadBus/index.php
real-time bus tracker
The most direct way to see real-time bus locations and their stops with location-based information 

*********IMPORTANT**********
Yes we have noticed that there's another Madbus on Github.
Clarification: We did not use any part of the code from that project
or in any way plagarize the project. We built this application 
while participating in the MadHacks 2019 Spring. Our project and the other 
Madbus does not have any form of connection. In fact we didn't even know 
there's such a project while we built this application. We just happen to have
the same name. :)
Site: lyuxuan.com/MadBus/index.php
*********IMPORTANT**********

# Inspiration

According to our own experiences with Google Map when searching for bus lines, we sometimes suffer from the complex operations and not seeing the exact location of the bus visually on the map (Google Map only supports text-based information about the bus schedule and only one bus at a time if you want to track). So we implement an improved version of Map with the real-time bus lines.

# What it does

    It can display all buses at present on one single page directly showing route number
    The buses are moving on real-time with positions updated around every 30s.
    It can show all stations of the chosen bus line upon request.
    It can highlight all the buses with chosen route number upon request.
    It displays route KML object for selected routes
    It is able to project user location on the map
    It is able to show the closest stops from user location within 200 meters
    lyuxuan.com/test.php

# How we built it

We implemented this web-based bus tracker using Javascript and PHP, while making use of various convenient functions provided by the HERE API. We first broke down the whole idea into smaller pieces and then tackled each problem following a bottom-up fashion. After successfully completed the tracking functionality, we also brainstormed more features that could improve the user experience, such as to choose a particular bus line and highlight particular bus stops.

# Challenges we ran into

We did not know web programming language very well. It took us a large amount of time to get familiar with javascript, php to build up the web page with direct information in good-looking form. Here API is an excellent tool undoubtedly, though, mastering it is not that easy for us. To make use of it to implement our ideas, we need to know not only how it works but also how to modify codes accordingly. Last but not least, since we needed real information about Madison transportation, we worked on data from cityofmadison.com, which included real-time bus GPS locations in json format and bus stops information in excel format. Both the share between crossing-origin resources and the parsing of data were big problems to be dealt with.

# Accomplishments that we're proud of

We have successfully developed a real time bus checking service and by interacting with the map, a route is highlighted for the selected route. We had a lot of difficulties trying to communicate with different APIs both from the Madison Metro system and Here’s map API. It is quite an accomplishment that we have built an operational and useful tool.

# What we learned

We learnt how to use Javascript, php, Here API and raw data from other sources to implement the website, especially how to transfer different types of data of different language. We also learnt from the functionality of editing and implementing the map provided by HERE API, like how to put and edit markers on the map.

# What's next for Madbus: real-time bus tracker

    To solve CORS(cross-origin resources share) problem without Chrome extension.
    Shorter update time.
    After choosing one bus, the completed driving line of the route can be shown on map.
    The direction of the bus line can be shown on map.
    The website can be accessed by phone.
    To support navigation from current location to destination.
    To deal with incorrect inputs
    Etc

# Built With:
    Here API
    PHP
    Javascript
# Try it out:
    http://lyuxuan.com/MadBus/index.php
    
MadHacks 2018
Created by
#
Yuxuan Liu, 
York Li, 
Yao Yao, 
kejiaf
