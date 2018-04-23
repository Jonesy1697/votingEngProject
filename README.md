# votingEngProject
This project aims to demonstrate the methods and technologies available to
implement e-voting within the United Kingdom general elections. This will
consist of two seperate systems, one programmed in Java to handle election
administration, and another system using HTML, CSS and PHP to allow a person
to vote in an election.

## Getting Started


These instructions will get you a copy of the project up and running on your
local machine for development and testing purposes. See deployment for notes 
on how to deploy the project on a live system.


The program will require a virtual server, such as XAMPP, which will host the
database used in the systems.

### Prerequisites


To run the program, an appropriate web server, such as XAMPP, to host the
database needed for the systems to work. Once downloaded, copy and paste
the SQL code onto the virtual server, so to set up the database the systems
will use.
 Finally, copy and paste the system website into the web server
folder, so that the website can be hosted from a private computer.


### Installing


Before starting, download a web server, as specificed in prerequisites. Once
downloaded, enter the SQL code in the project, which will create the database to
be used. When this SQL has been run, test the database to ensure SQL was successful,
collecting users from the database, with the following line
```
Select * from voter
```



Once the database has been successfully installed, the voting website should be
accessible through the local host, provided it has been correctly placed. At this
point, no votes should have been placed, so the user should be able to log in as
any voter with the correct ID and password.




## Running the tests


To test the voting system, enter the correct user details, ID and password, when on
the main login page of the voting system. This will redirect a user to submit a vote,
and once the vote has been submitted, will display who was voted for in the database.
```
UserID = AC-71
Password = 1234
```




To test the administration system, open the compiled Java program, and enter the
administrator details. This will then direct the user to the main menu, where results
can be viewed.


### Break down into end to end tests


Explain what these tests test and why





### And coding style tests


Explain what these tests test and why



## Deployment


Add additional notes about how to deploy this on a live system



## Built With


* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used

* [Maven](https://maven.apache.org/) - Dependency Management

* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing



Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.



## Versioning


We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 



## Authors


* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)



See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.



## License


This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Acknowledgments


* Hat tip to anyone who's code was used

* Inspiration

* etc

