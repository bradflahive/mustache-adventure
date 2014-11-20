# Man Page

## MVP
- [ ] Home page/login/create account
  - [ ] Dynamically switch between login/create acct
- [ ] Profile page
  - [x] Logo
  - [ ] Profile info
    - [ ] CSS
      - [ ] Picture
      - [ ] Contact info
      - [ ] Points awarded

  - [ ] Submit post
  - [ ] Feed of everyone
    - [ ] Each post
      - [ ] Who
      - [ ] Picture
      - [ ] Description
      - [ ] Award points to someone (dropdown 0-5)
      - [ ] Total points awarded so far.
  
  - [ ] Misc tasks:
    - [ ] Review of other code to increase understanding
    - [ ] Review of MVC in general
    - [ ] Check code for repeats, consolidate to DRY
    - [ ] Add notes to code indicating what's needed to input and the expected output
    - [ ] Check view templates
    - [ ] Review naming conventions in code, make sure consistent (minimize refactoring)
    - [ ] Code reviews?


  - [ ] Models
    - [ ] User
      - [ ] create user
      - [ ] Pull info for profile, populate profile page with profile info (user_id table)
      - [ ] Ability to update user (CRUD)
      - [ ] Delete user (if don't do friends...need delete in CRUD)
      - [ ] Retrieve number of points total for user
    - [ ] Feed
      - [ ] Pull info in for feed.  Populate feed with info from comment and man_points tables
      - [ ] Post/submit button should create new post.
      - [ ] AJAX to insert post to page and insert into DB
      - [ ] Ability to update points given to someone for a post?
      - [ ] Delete posts?
      - [ ] Retrieve number of points that have been given to the post.
    - [ ] Login helper
      - [ ] Get data
      - [ ] Check against DB
      - [ ] If correct, send to profile
      - [ ] If incorrect, give prompt to user for correct info.
    - [ ] Output escaping (XSS)
      - [ ] Writing of class/function.
      - [ ] Implementation of class/function.
    
  - [ ] Validation
    - [ ] Verify working on backend (PHP)
    - [ ] Utilize reptile forms to make sure that it's working as expected
    - [ ] Deal with response data in user friendly way



  
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

