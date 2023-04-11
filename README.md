# tiny_chemistry
Chemistry equation editor for Tiny Editor in Moodle (Version 4.0 and above) using the mhchem extension in MathJax/TeX. This plugin is based on equation editor (original by Huong Nguyen <huongnv13@gmail.com>) and was modified by TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at) for chemistry formulas.

## Version info

### Plugin-Version: 2023010903 (Moodle 4.1)

* Prepare first version of chemistry editor

## Installation
Download the zip file, unzip to a folder. Rename this folder to chemistry and copy to the lib/editor/tiny/plugins folder of your Moodle.
Please note this version is only valid for new Tiny MCE Editor in Moodle 4.1 and above.

Then visit the Admin notifications page of your Moodle to complete the installation.

After installation you need to complete the following steps:

### Mathjax filter config
Add additionally to standard Mathjax configuration the mhchem-config to the Moodle MathJax filter configuration:

Edit Administration > Site administration > Plugins > Filters > MathJax > MathJax configuration to include:

```
MathJax.Hub.Config({
        TeX: {extensions: ["mhchem.js"]}
        });
```
Please note: do not delete standard Mathjax config in Moodle!

### Chemistry editor tabs config
Add specific TeX commands to the different tabs. Maybe you can use the standard settings below each tab.

### Purge caches
You may need to Purge all caches on your browser and your Moodle server: Administration > Site administration > Development > Purge all caches