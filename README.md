# minesweeper-API
API test

We ask that you complete the following challenge to evaluate your development skills. Please use the programming language and framework discussed during your interview to accomplish the following task.

## The Game
Develop the classic game of [Minesweeper](https://en.wikipedia.org/wiki/Minesweeper_(video_game))

## Show your work

1.  Create a Public repository ( please dont make a pull request, clone the private repository and create a new plublic one on your profile)
2.  Commit each step of your process so we can follow your thought process.

## What to build
The following is a list of items (prioritized from most important to least important) we wish to see:
* Design and implement  a documented RESTful API for the game (think of a mobile app for your API)
* Implement an API client library for the API designed above. Ideally, in a different language, of your preference, to the one used for the API
* When a cell with no adjacent mines is revealed, all adjacent squares will be revealed (and repeat)
* Ability to 'flag' a cell with a question mark or red flag
* Detect when game is over
* Persistence
* Time tracking
* Ability to start a new game and preserve/resume the old ones
* Ability to select the game parameters: number of rows, columns, and mines
* Ability to support multiple users/accounts
 
## Deliverables we expect:
* URL where the game can be accessed and played (use any platform of your preference: heroku.com, aws.amazon.com, etc)
* Code in a public Github repo
* README file with the decisions taken and important notes

## Time Spent
You do not need to fully complete the challenge. We suggest not to spend more than 5 hours total, which can be done over the course of 2 days.  Please make commits as often as possible so we can see the time you spent and please do not make one commit.  We will evaluate the code and time spent.
 
What we want to see is how well you handle yourself given the time you spend on the problem, how you think, and how you prioritize when time is insufficient to solve everything.

Please email your solution as soon as you have completed the challenge or the time is up.

## Planning notes

* Review parameters of projects.  Make sure that I understand exactly the size/shape of box in which I can work.  TIME CONSTRAINTS MATTER.
* Review definitions.  Make sure that you are back on textbook with definitions (IE: RESTful API -- just because you think your defaults are restful, doesn't mean they'll meet other people's definition)
* Set up environment needed to build/test/etc, Choose tools to use within above constraints.
  * Laravel offers high degree of familiarity and meets constraints.  Gets me across the finish line faster!
* Triage.  Determine, given constraints, which requirements are going to be met/ignored, high/low, and precedence. 
  * Decide up front to implement persistance and users (YES, BTW) because they are top of precedence.  Refitting for this later kills time. (Laravel offers users out of the box)
  * Decide up front that game parameters are prolly not going to make it to the final cut.  reduces time, but can be retrofitted easily if time permits.
  * Have a design in mind for the whole thing before starting to code anything.  (You got to know where your going before you step out the door, or you're lost)
* Decide your implementation. 
  * JS frontend, PHP backend. 
  * Use jQuery, leave off Bootstrap.  Pretty comes after functional.
  * MySQL is somewhat inelegant for this application, but helps with the time constraint.  I think I'd rather find a lighter solution (text files?)
* Write these notes.  A roadmap for myself, and progress report for the client (YOU).
* Execute first commit with these notes, to start the timer (did I do that already by creating the repo?  LOL)
* GO.  Document API calls as they are built (/help)

