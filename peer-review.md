## P3 Peer Review
+ Reviewer's name: Michaela DeForest 
+ Reviwee's name: Stephen Dudeney
+ URL to Reviewe's P3 Github Repo URL: *<https://github.com/rdudeney/p3>*

## 1. Interface
Address as many of the following points as applicable:

+ I really like the concept used in this application and the presentation of the application. Including references to information on the Monty Hall Problem was a nice addition. 
+ The instructions and form were slightly confusing. I did not understand right away why I was choosing to repeat x number of times.
+ The presentation of the results were displayed in an easy to understand way and the form worked as it should.
+ Some of the text was aligned in a way that did not neccessarily seem consistent. More spacing in between sections may be nice, especially because the text is dense.


## 2. Functional testing
+ Submitting the form wthout data returns errors as expected.
+ Submitting the form with partial data returns errors as expected.
+ Entering invalid inputs into the "guess" form field returns errors as expected, however one of the errors has a typo in it (entering letters). It would be nice if the max was set to be the same as the number of times set to repeat. (e.g. 100 instead of 999 when you choose 100 as the number of repetitions)
+ Accessing a URL that is not part of the site returns a 404 page as expected.
+ Accessing /processInput without the form redirects to the form as expected.
+ Accessing /winner without actually winning does not return any error. Maybe it could use sessions or cookies to redirect back to the index page if you have not actually won.

## 3. Code: Routes
There is no code in the `routes/web.php` page that should be in the controllers.

## 4. Code: Views
+ Template inheritence is used well by creating a master layout that is used in the other two pages.
+ There were no issues regarding separation of concern in any of the view files. All code is necessary for display.
+ There was no PHP code in the view files, everything was done correctly with Blade.
+ I was familiar with all of the Blade syntax/techniques.

## 5. Code: General
+ I did not find any inconsistencies in code style. The code follows all of the guidelines outlined in the notes.
+ Best practices were used very well in the code. There could possibly be more separation of sections within the view files (e.g. grouping the header text, explanation, and form in separate tagged sections)
+ I think all of the code was commented very thoroughly. There is always a risk in not only a lack of comments, but also too many comments. This code has found the right balance.
+ I like the use of helper methods that have been made private. This keeps the code clean. You may even consider including that code in a separate file.
+ The code is easy to understand because it is commented so well.

## 6. Misc
This project was really well executed! Good Job!
