# Manpoints Page

## MVP

## Priority
- [x] cleanInput - increase understanding/fix.  Example error when trying to submit: 
Fatal error: Call to undefined method Controller::cleanInput() in /home/na/Sites/mustache-adventure/app/models/comment.class.php on line 36
- [x] main.js - append new comment to aside (may be working after cleanInput fix)
- [ ] main.js - Submit scores upon dropdown change
- [ ] fix login (hash creation of new users) (and also creation of users)
- [x] sort out issues with Ajax Controllers in returning non-objects.
- [ ] login and use of sessions
- [ ] ability to delete own comments (or user?)
- [ ] fetch comments from DB that have 0 points
- [ ] Retrieve number of points total for user

# HTML/CSS
- [x] Home page/login/create account
  - [X] Dynamically switch between login/create acct
  - [x] Validate info from selected form
  - [x] Present any errors to users in friendly way
- [x] Profile page
  - [x] Logo
  - [x] Profile info
    - [x] CSS
      - [x] Picture
      - [x] Contact info
      - [x] Points awarded
      - [x] Ratings system

  - [ ] Submit post
    - [x] figure out issue with reptile forms or plan new strategy
    - [ ] test for issues with punctuation ' and " and \ and / in comments
  - [x] Feed of everyone
    - [x] Each post
      - [x] Who
      - [x] Picture
      - [x] Description
      - [x] Award points to someone (dropdown 0-5)
      - [x] Total points awarded so far.
  
  - [ ] Misc tasks:
    - [ ] Check code for repeats, consolidate to DRY
    - [ ] Add notes to code indicating what's needed to input and the expected output
    - [x] Check view templates
    - [ ] Review naming conventions in code, make sure consistent (minimize refactoring)
    - [ ] Code reviews?

  - [ ] Models
    - [ ] User
      - [x] create user
      - [x] Pull info for profile, populate profile page with profile info (user_id table)
      - [x] (LATER) Ability to update user (CRUD)
      - [ ] (LATER) Delete user (if don't do friends...need delete in CRUD)
      - [ ] Retrieve number of points total for user
    - [ ] Feed
      - [x] Pull info in for feed.  Populate feed with info from comment and man_points tables
      - [x] Post/submit button should create new post.
      - [ ] ability to delete own post
      - [x] AJAX to insert post to page and insert into DB
      - [ ] Ability to update points given to someone for a post?
      - [ ] Delete posts?
      - [x] Retrieve number of points that have been given to the post.
    - [ ] Login helper
      - [ ] Get data
      - [ ] Check against DB
      - [ ] If correct, send to profile
      - [ ] If incorrect, give prompt to user for correct info.
    - [ ] Comments
      - [x] Pull in comments from DB and populate profile page
      - [ ] ability to update points given to someone for a post.
      - [ ] Track already existing vote from the user


 # View     
  - [ ] Output escaping (XSS)
    - [ ] Writing of class/function.
    - [ ] Implementation of class/function.
    
  - [x] Validation
    - [x] Utilize reptile forms to make sure that it's working as expected
    - [x] Deal with response data in user friendly way
    - [x] Validation - php built-ins

# JS
  [x] Profile page
    [x] Post new comment
      [x] Needs to grab content in text area/input and appened to top of feed
      [ ] Enforce a # character limit?
    [ ] Comments in feed
      [ ] Comment will need to be updated with points total when page is loaded
      [ ] When voting, pull vote #, insert to DB, update points total




  
## Extras
- [ ] Image for profile
- [ ] Friends
  - [ ] Filter feed based on friends
- [ ] Bar showing how manly a status is
- [ ] Account settings
- [ ] Bar graph showing points
- [ ] Ability to raz guys
- [ ] Contact page
- [ ] FAQ page
- [ ] Find new logo

