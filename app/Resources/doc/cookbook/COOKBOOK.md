# The Cookbook

## Introduction

This project serves two purposes :
- Building an application suited to my needs as an antiques collector (but well, should work for any collection)
- Providing a bit of knowledge regarding PHP, Symfony, MVC, and so on, based on a solid architecture to someone close to me.

## Requisites
This cookbook is provided as is, and is targeted to a Debian Based Linux audience (chiefly, because it's easy to use and often targeted in releases, Ubuntu)

### Revision Control
#### What is Revision Control
Imagine you are writing code, several kilo instructions per day.

Now, ask yourself these questions :
- How do keep track of all the dirty hacks I've made ?
- How can I be sure some quantity of work won't be totally erased for no good reason ?
- How can I go back in time to understand where a bug came from ?


Revision Control is also known as "Source Control" or "Version Control" : it aims at providing the history of all the modifications on a sub file system, such as a folder or a file.

#### Key Concepts

Now, let's say you want to add some lines in a file. Here are the "universal" steps which happen when working with Revision Control

##### Checkout
Checking out consists in fetching a working copy from the Revision Control System (RCS).

There are several "flavors" of check out, here are some :
- Optimistic (nothing asked) checkout: the RCS assumes that you know what you are doing, and if another person is working on the same file, you will have to deal with your problem as adults
- Pessimistic checkout: hell no, you are not allowed to edit this file, someone else is working on it (basically the system puts a lock when another user has checked out the file)
- File vs Working Set : some systems checkout individual files, some other a group of files as a working set

##### Diff
Let's be clear on two points :
- Most of the time, RCS conceptors are far better programmers than you or me can be, they would not store the whole file everytime you change it
- And, actually, what you really want to know is how much your code has changed.

That's the purpose of the Diff : pointing out the differences (most of the time line by line, character by character) and only saving them.

Stacking all the differences together one after the other gives you the resulting diff between two versions of the same file.

##### Staging
Staging is an often optional system, consisting in regrouping together all the files you have changed in a single-purposed "change" (see commit)

##### Commit
That's where the magic happens. Whatever it applies to, a commit is, broadly, for each file :
- Putting the lock on the reference file
- Computing the diff
- Applying the diff to the reference file
- Saving the reference file with version n+1
- Releasing the lock

As always there is metadata : commit number, timestamp, committer, etc.

#### Different kinds
RCS come in different flavors, according to your needs.

Up to circa 2007, most RCS where labeled as "centralized" and "linear"
- There is one reference source code repository (a repository is a particular kind of storage, which provides history, certification, and persistence) on a dedicated server
- There is one trunk, it is possible to branch, but everyone has to work on the same branch
- Merging, while mandatory, is not the priority of such systems, adapted to long development cycles

But then again, if you have multiple workers working at the same time to add functionalities to a same set of files, providing, in fine, a "patch", you can't always expect they will deal with conflicts smoothly.

No, what you would like is a RCS that allows anyone to propose his patch, or a set of his patchs, and the community of developers to review them.
For that to work, independent workers should not be hassled by every change in the reference repository.

And thus appeared "Distributed Revision Controle Systems".
Every user has a copy of the "reference repository" or a copy of a copy, and can create working sets for every patch, and then propose said patch as a diff set to be included in the central repository after a consensus.

The "reference" repository is arbitrary. In our case, that would be the repository you may be browsing on GitHub.

#### GIT
Ok, let's install GIT
$ sudo apt-get install git git-cola
