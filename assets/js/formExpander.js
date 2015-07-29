var sections;
var subsections;
var x;
var subsectionButtons;
var sectionButton;
var revealedSubsectionCounters;
var reavealedSectionCounter;


function setup() {
    // Gets all 'row sections' in our html doc, stored in an array
    sections = document.getElementsByClassName('section');
    sections[0].style.display = 'inline';


    sectionButton = document.getElementsByClassName('sectionButton')[0];

    // Counter array that keeps track of how many subsections have been revealed for each section (which is the index of the array)
    reavealedSubsectionCounters = [];
    for (i = 0; i < sections.length; i++) {
        reavealedSubsectionCounters.push(1);
    }

    revealedSectionCounter = 1;

    //Sets the first subsection of section one visible
    subsections[0][0].style.display = 'inline';
}



function showSubsection(sectionID) {
    var parseSectionID = sectionID.split('-');
    var sectionNum = parseSectionID[1];
    var section = subsections[sectionNum];

    section[reavealedSubsectionCounters[sectionNum]].style.display = 'inline';

    if (reavealedSubsectionCounters[sectionNum] == 3) {
        subsectionButtons[sectionNum].style.display = 'none';
    }
    else {
        reavealedSubsectionCounters[sectionNum]++;
    }
}

function showSection() {
    sections[revealedSectionCounter].style.display = 'inline';
    subsections[revealedSectionCounter][0].style.display = 'inline';

    if (revealedSectionCounter == 2) {
        sectionButton.style.display = 'none';
    }
    else {
        revealedSectionCounter++;
    }
}