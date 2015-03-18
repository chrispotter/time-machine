#Time Machine
##Blue Acorn's 1x/2x Combined Module POC
We wanted to build a sample solution showcasing a practical way to build and deploy a feature compatibible with both 1x and 2x while sharing some common code.

Shared Logic
---
Our solution adds an object to the lib/ of both codebases, this file contains shared logic and can be updated independantly of the version specfiic module. This object is exposed in the module's data helper.

Shared Templating
---
Our solution uses a frontend template and a js file in common between the two modules. We've placed these common files in a 'common' directory at the base of this repo. Using modman, we link these files in the appropriate spots in the codebase.The Magento specific module still needs to account for these modules, but provided you follow the appropriate practices you should be able to write a template phtml that will effectively work on both frameworks.

Sharing javascript works on the same basic princpal. We write a frontend object that's effectively platform agnostic, and use a platform specific wrapper (v2 has to work with require.js, for example) and add then add the js file with the shared logic seperately. 

### Version
0.0.1
### How To Install
This should look pretty familiar...
1. Clone this repo down somewhere.
2. In your magento repo: `modman init`
2. In your magento repo: `modman link /path/to/repo/v2/`

Then configure just as you would any other Magento module. 

#####By: Shawn Foster, Doug Hatcher, Jay Ivanov and Chris Potter, Chris Rasys
