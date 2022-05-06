# Stylish Bootstrap QR-Generator

![Stylish Bootstrap QR-Generator](https://raw.githubusercontent.com/egy1st/images/main/logo/qr-logo.png)

## What is QR-Code

Almost 30 years ago the Japanese company Denso Wave (owned by Toyota) invented QR codes. These 2D images can encode pretty much any Unicode string.

## Installation

- Download zip file
- Unzip it
- Upload extracted folder to your server
- go to http://myserver.com/qr-folder/  here myserver.com is your website URL and qr-folder is anme of extracted folder.

## Interact with this QR-Generator

[![Interact with this QR-Generator](https://img.shields.io/badge/interact%20with-Me-orange)](http://api.zerobytes.one/qr/) 


## Features

Here are some key features:

- 10+ possible types Text, URL, Telephone, SMS, Email, Email Message, vCard, meCard, WiFi access, Geo location, Calendar event

- User friendly interface

- Built for easing up your work using cutting edge technology, Bootstrap

- Nine sizes are allowed:

  - 100x100
  - 150x150
  - 200x200
  - 250x250
  - 300x300
  - 350x350
  - 400x400
  - 450x450
  - 500x500

- Three encoding format are allowed:

  -  UTF-8, ISO

  -  8859-1
  -  Shift_JIS

- Multiple Correction levels
  QR codes include an error correction scheme which comes with a certain overhead. Four levels of error    correction are available - the more error-resistant the code, the more rows/columns of pixels are needed:

  - L copes with up to 7% data loss
  - M copes with up to 15% data loss
  - Q copes with up to 25% data loss
  - H copes with up to 30% data loss

- There are lots of Query Ui styles to selct form at http://jqueryui.com/themeroller/.  I'm using Blitzer theme from http://jqueryui.com/themeroller/Blitze 

- Images generated via Google Infograph API. The infographics server returns an image in response to a URL GET or POST request. All the data required to create the graphic is included in the URL, including the image type and size. For example, copy and paste the following URL in your browser:

>  https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Hello%20world
>
>  The image you see is a QR code representation of the phrase "Hello World". Try changing the phrase to your own name and refresh your browser. That's all it takes!

 

## HTML Structure

I use as a framework, the BOOTSTRAP Framework. You can take a look here http://twitter.github.com/bootstrap/  and see it's awesome feature in action

## CSS Files and Structure

I'm using Blitzer theme from http://jqueryui.com/themeroller/
It is properly licensed under MIT License

## Styles needed for Bootstrap

<!-- Bootstrap -->
 <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 <link rel="stylesheet" href="css/style.css" />

Style needed for the working theme

 <link rel="stylesheet" href="css/blitzer/jquery-ui.css" />

 There are lots of Query Ui styles to select form at http://jqueryui.com/themeroller/.  , then just replace blitzer with your downloaded and zipped theme.

 

## JavaScript Files

The JS files used in this QR Generator are:

- bootstrap.min.js
- jQuery-1.9.0.js
- Modernizr
- globalize.js
- jquery.mousewheel.js
- jquery.validate.min.js
- jQuery-ui-1.10.0.custom.js
- globalize.js
- qr.js

## SOURCE & CREDITS

SCRIPTS:

- Bootstrap Framework http://twitter.github.com/bootstrap/
- Modernizr - http://modernizr.com/
- jQuery Framework http://jquery.com/
- jquery ui theme Framework http://jqueryui.com/themeroller/
