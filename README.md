# votingEngProject
This project aims to demonstrate the methods and technologies available to implement e-voting within the United Kingdom general elections. This will consist of two seperate systems, one programmed in Java to handle election administration, and another system programmed in HTML, CSS and PHP to allow a person to vote in an election online. The two systems will be used seperately, and when one is active, the other cannot be used to disallow administration editting to databases during an election, and to disallow voting when administrative repairs are being made.

## Getting Started
These instructions will walk through the download of the project and running on a local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

The program requires a virtual server, such as XAMPP, to host the database used in the systems, as well as to host the webpage which enables a voter to submit a vote. The program may also require a Java editor, such as Netbeans, and a text editor for HTML, CSS and PHP, such as Notepad++, should a developer wish to make changes to the source code. If changes are made, ensure that code is recompiled and that the edited websites are stored on the hosting folder in the virtual server.

Links for all software suggest can be found in the Built With chapter of the readme.

Firstly, ensuring that all source code has been downloaded, so that it can be executed in later steps.

Before starting the system, download a web server, as specificed in prerequisites. Once downloaded, enter the SQL code in the project, which will create the database to be used. When this SQL has been run, test the database to ensure SQL was successful, collecting users from the database, with the following line:
```
Select * from voter
```
Once the database has been successfully installed, the voting website should be accessible through the local host, provided it has been correctly placed. At this point, no votes should have been placed, so the user should be able to log in as any voter with the correct ID and password.

## Running the tests
To test the voting system, enter the correct user details, ID and password, when on the main login page of the voting system. This will redirect a user to submit a vote, and once the vote has been submitted, will display who was voted for in the database.
```
UserID = AC-71
Password = 1234
DOB = 13/06/1985
```

To test the administration system, open the compiled Java program, and enter the administrator details. This will then direct the user to the main menu, where results can be viewed.
```
UserID = 1
Password = password123
DOB = 13/06/1985
```
## Deployment
To deploy this system as a public domain, a public server will need to be implemented, such as through a raspberry pi and public IP address. More information on how to do this can be found online, alongside several tutorials.

## Built With
* [XAMPP](https://www.apachefriends.org/index.html) - The virtual server
* [Netbeans](https://maven.apache.org/) - The Java environment
* [Notepad++](https://notepad-plus-plus.org/) - The web environment

## Authors
***Christopher Jones*** 
### Prerequisites
To run the program, an appropriate web server, such as XAMPP, to host the database needed for the systems to work. Once downloaded, execute the SQL code on the virtual server, so to set up the database the systems will use.

Finally, save the system website into the default server folder on the virutal, so that the website can be hosted from a private computer.

### Installing
