# moodle-filter-html5media
A Moodle filter which encodes media files supported by HTML 5 to the HTML 5 standard of embedding media content.

## Introduction
This filter will search for all links which are supported HTML 5 media types in the href and transform them to make playable within the browser without the use a flash or an external player. This makes Moodle more HTML 5 compliant and mobile friendly. A basic example of what this plugin does can been seen below.

You include a link to a video file as follows:
```
<a href="http://www.yourmoodlesite.com/media/movie.mp4">
```
The plugin will transform the url above into what is seen below.
```
<video width="320" height="240" controls>
	<source src="http://www.yourmoodlesite.com/media/movie.mp4" type="video/mp4">
	Your browser does not support the video tag.
</video> 
```

This plugin is not in any way to compete with the multimedia plugin which is part of the baseline code of Moodle but rather a filter which makes media files in Moodle more HTML 5 compliant. What does this mean? All devices will be able to play the media files with the browser’s built in media playback functionality so there is no need for third party tools like flash

## Requirements
 -  Moodle 2.6 or higher

# Installation
- Place the "***html5media***" (might need to rename the folder to "***html5media***") directory within your_moodle_install/filter/
- Visit the admin notifications page and complete the installation.
- Go to Home / Site administration / Plugins / Filters / Manage filters and turn on ***HTML 5 Multimedia***.
- Place ***HTML 5 Multimedia*** above the ***Multimedia plugins*** filter.
- Done!

## Supported media types
  - mp4
  - webm
  - ogg *
  - wav
  - mp3

>Media files with an .ogg extension will be encoded as audio.

## Author
- [Andre Dixon](https://moodle.org/user/profile.php?id=1956202)
- Website: http://www.dredix.net

License
----
[GNU GPL v3 or later](http://www.gnu.org/copyleft/gpl.html)

## Issues and Bug Tracking
Please report all issues with this plugin to the issues section of this git repository. 
[Report issue here](https://github.com/dredix84/moodle-filter-html5media/issues)
