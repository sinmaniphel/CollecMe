# Revision Control
## What is Revision Control
Imagine you are writing code, several kilo instructions per day.

Now, ask yourself these questions :
- How do keep track of all the dirty hacks I've made ?
- How can I be sure some quantity of work won't be totally erased for no good reason ?
- How can I go back in time to understand where a bug came from ?


Revision Control is also known as "Source Control" or "Version Control" : it aims at providing the history of all the modifications on a sub file system, such as a folder or a file.

## Key Concepts

Now, let's say you want to add some lines in a file. Here are the "universal" steps which happen when working with Revision Control

### Checkout
Checking out consists in fetching a working copy from the Revision Control System (RCS).

There are several "flavors" of check out, here are some :
- Optimistic (nothing asked) checkout: the RCS assumes that you know what you are doing, and if another person is working on the same file, you will have to deal with your problem as adults
- Pessimistic checkout: hell no, you are not allowed to edit this file, someone else is working on it (basically the system puts a lock when another user has checked out the file)
- File vs Working Set : some systems checkout individual files, some other a group of files as a working set

### Diff
Let's be clear on two points :
- Most of the time, RCS conceptors are far better programmers than you or me can be, they would not store the whole file everytime you change it
- And, actually, what you really want to know is how much your code has changed.

That's the purpose of the Diff : pointing out the differences (most of the time line by line, character by character) and only saving them.

Stacking all the differences together one after the other gives you the resulting diff between two versions of the same file.

### Staging
Staging is an often optional system, consisting in regrouping together all the files you have changed in a single-purposed "change" (see commit)

### Commit
That's where the magic happens. Whatever it applies to, a commit is, broadly, for each file :
- Putting the lock on the reference file
- Computing the diff
- Applying the diff to the reference file
- Saving the reference file with version n+1
- Releasing the lock

As always there is metadata : commit number, timestamp, committer, etc.

## Different kinds
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

## GIT
Ok, let's install GIT
```
$ sudo apt-get install git git-cola
```

Here we go.
Git-cola is a graphical tool for git. But well, we are first going to use the command line

### The source folder
You are going to actually download a set of files on your computer, strictly identical to the files you see right now.
So first, we are going to create the folder where we will download these source files
```
$ cd ~
$ mkdir -p dev/PHP/projects/
```
The first instruction brings you back to your home folder, the second creates the folder, the -p option creating successively all children

Now go to the folder you have created

```
$ cd dev/PHP/projects/
```

### Getting the source
Now, we are going to actually clone the GitHub repository
```
$ git clone git@github.com:sinmaniphel/CollecMe.git
```

Lo ! You have the source code on your computer
The clone command creates a copy of the original repository, with all the change history. It's actually not as heavy as you would imagine. 

Now go in the correct folder
```
$ cd CollecMe
```

### Working with branches
Working on a branch, that is, on a subcopy of the repository, is common practice with GIT.

To start working on a branch, you must create it, and then swith to it using a checkout

This is quite easly done with the following command :
```
$ git checkout -b branch_name
```

A good practice that I will enforce on this project is creating a branch with a pull request in mind.
A good naming convention would be, for example *pr-security-ACL-rolelist*

The main branch is the "master", and you can switch branches with git checkout, without the -b option

### Pushing and pulling
Right now you should have understood that a branch is a working set on a repository which is a clone from a remote one.

Pushing and pulling consists in synchronizing your working set with remote ones.

Pulling fetches the code from a branch the remote and updates your code (conflicts may happen).

```
$ git pull remote branch
```

If you want to "provide" your branch to the remote, you push it

```
$ git push remote yourbranch
```

### Adding a new file
you can either use the "git add" command or do it via git cola

### Staging and commit
In a first time, it will be easier for you to use git cola
- Select the files you want to commit and stage them with a right click
- Check the resulting diff
- Enter a commit message (mandatory)
- Hit commit

### Useful git commands and tips
#### git branch
```
$ git branch
```
This command will list all the branches you have available and highlite the one you are currently on

#### hoping to another branch
```
$ git checkout branch_name
```
You may be working on several issues at the same time. Switching from branch to branch allows you to separate your work, and you will always have your files and folders as they were at the time of your last commit. 

Also, as said above, to each branch it's pull request, it allows to correctly identify which code resolved which issue.

#### Updating from the master (or another branch) before a push
The master, that is, the main reference source code (which is, actually a branch created initially by convention), may change during the time you are working on your part.

To be sure that your code is up to date with the master, simply pull the master while you are on your branch
```
$ git checkout your_branch
$ git pull origin master
```
You may be asked to input a message. The default editor for Ubuntu is nano, which is not that easy to handle.
Simply imput something like "update from master", Ctrl+O to write it, and another combination to quit (Ctrl-X if my memory serves well)

#### Merging and conflicts
When you pull the master to update your code, what actually happens is that all the diffs that are easy to compute are applied, and then the code is commited.

That operation is called "merging".

Some operations are not easy to compute, for example when someone updated a part of the code you were working on. 
In those situations, your favorite tool (git cola, or a git package for atom) will provide you help in putting things together, showing conflicting files and even proposing solutions.

A good way to list all the conflicts is to use
```
$ git status
```
