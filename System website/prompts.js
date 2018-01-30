function loginHelp() {
	alert("To vote on the system, users must first log on. \n \n To do this, please enter your voter ID, found on your polling card, you chosen password and your date of birth.");
}

function votingHelp() {
	alert("This is the page to vote. \n\n Select your chosen candidate from the list of candidates in your area, and then select submit");
}

function incorrectLoginHelp(){
	alert("The details you entered were not correct. \n\n Please recheck your voterID and password before trying again.");
}

function alreadyVotedHelp(){
	alert("The voterID entered has already been used to vote. Votes cannot be resubmitted or changed.");
}

function voteSubmittedHelp(){
	alert("Thank you for submitting your vote. Your vote can no longer be changed.");
}

function votingClosedHelp(){
	alert("Voting is currently not open, please wait until an election is in progress.");
}