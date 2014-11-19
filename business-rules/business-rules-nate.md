

NEW USER will arrive at site and wonder what the site is for.  The home page indicates the gist of the site and gives them the option to create a page or review a FAQ.  When they view the FAQ, they're redirected to Better Homes and Gardens.  If they want, they can choose to create an account.

NEW USER wants to create an account.  They are at the home page and click on "New Account/Register".  A form pops up (or separate page) allowing for them to fill out information.  The information is corrected and they then begin creation of a profile.  After creation of a profile, they're awarded manpoints (Awarded Points) and also given points to give to others (Give Points).  They can find friends and also post to their own wall announcing something "manly".
--a new user is created in the users table.  They have an entry in the awarded-points table since they've created an account.  They also have an entry in the give-points table.  A first comment/event is created showing that they've created an account and joined.

USER visits the home page.  They login to visit their profile-home.  They can view friends and on their feed are activities from their friends.  They can also add friends, or post something on their own wall.
--When they login, they gain give-points.  Friends (NEED THIS TABLE) are shown after running a query (need to store pictures).  A query needs to be run to show recent events from friends.

USER wants to add a friend.  They search for someone by username or e-mail address.  They can then review a person's bio and request to follow them.
--They search database for people matching the name/e-mail address along with those that wish to be public.  A person's bio will need to be pulled when selected.  If a request is made, a pending request needs to be queue'd and reflected so that the other user knows there's a pending request.

USER gets alert that someone wants to follow/friend them.  On his profile page he can review and accept/decline such requests.
--User should see all pending requests (query) and be able to accept/decline them.  If declined, another request can't be made for X days.  If accepted, DB is changed to reflect the relationship.

USER gets awarded points, is alerted on his profile page (maybe contacted via e-mail?).
--A friend gives someone points.  The awarded-points is changed and give-points are reduced for the friend that gave them.  Pending alerts should have a status (reviewed or not?)

USER posts something about his friend.  Friend gets alerted.  When posting about his friend, has to give points to his friend.
--comment DB is changed and shows the two parties. (What about multiple friends?).  Friend is alerted.  If requirement is to use points to post about someone else, then reduce give-points and increase award-points as needed.

USER cannot visit a friends page, as only a friend's updates will populate their feed.?
--User wants to view friends page...needs to query DB for comments made about or to and populate the page.

NON-USER wants to view bios.  They are unable to do so.  MAYBE: They can only view updates on the main page (that are public).  They will need to create a profile to interact with anyone.
--Pages that are flagged private aren't searchable except by...  ???  On front page, recent updates that are public populate the page.

USER sees an update from a friend in their own feed.  They can award points.
--When a user comes to their profile page, they will see updates from their friends.  Tehy can award points.  If they do so, their give-points are reduced and friend's awarded-points increase.

USER wants more give-points.  When he logs in, gets a set number of points each visit to give.
--user logs in and give-points are increased.

USER gets give-points when he logs in daily (hourly?).

USER will be awarded points when he accomplishes certain tasks via sponsors on site.


USER is awarded points based on his profile upon creation.  He can also update his profile...  (should this have any bearing on his awarded points?  People should decide if he's to get points instead of being able to lie about some event on their profile and be awarded.)

USER wants to delete his account.  He can do so by going to profile settings.
--user has his user-id and everything connected to it (comments, etc) deleted from DB's.  In order for friends to keep their points, will have to keep in awarded-points give_user_id some sort of value, because then history of what event got points (and awarded-total) would be changed.

USER wants to change his account.  He can do so by going to profile settings.
--any changes will need to be validated and also table updated accordingly.








