<?php
  if (strpos($_SERVER['REQUEST_URI'], 'event') > 0) {
?>
<style>
.calendar {
  color: white;
  font-weight: 300;
}

.calendar * {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.calendar.small {
  font-size: 0.8em;
  font-weight: 100;
}

.calendar .c-month-view {
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  transition: all 0.5s;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  height: 9.5%;
  position: relative;
  font-size: 1.6em;
  margin-bottom: 1px;
  text-align: center;
  background-color: #232323 !important;
}

.calendar .c-month-view .c-month-arrow {
  width: 15%;
  height: 100%;
  position: absolute;
  top: 15px;
  /*color: transparent;*/
  cursor: pointer;
}

.calendar .c-month-view .c-month-arrow:hover {
  background: rgba(255,255,255,0.25);
}

.calendar .c-month-view .c-month-arrow[data-dir=left] {
  left: 0;
}

.calendar .c-month-view .c-month-arrow[data-dir=right] {
  right: 0;
}

.calendar .c-holder {
  height: 90.5%;
  position: relative;
}

.calendar .c-holder .c-grid {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  width: 100%;
}

.calendar .c-holder .c-grid .c-row {
  width: 100%;
  margin-bottom: 0.2%;
  margin-bottom: -moz-calc(0px + 1px);
  margin-bottom: -o-calc(0px + 1px);
  margin-bottom: -webkit-calc(0px + 1px);
  margin-bottom: calc(0px + 1px);
  height: 13.08571%;
  height: -moz-calc(100%/7 - 7px/6);
  height: -o-calc(100%/7 - 7px/6);
  height: -webkit-calc(100%/7 - 7px/6);
  height: calc(100%/7 - 7px/6);
}

.calendar .c-holder .c-grid .c-row:last-child {
  margin-bottom: 0;
}

.calendar .c-holder .c-grid .c-row .c-day {
  margin-right: 0.2%;
  margin-right: -moz-calc(0px + 7px/6);
  margin-right: -o-calc(0px + 7px/6);
  margin-right: -webkit-calc(0px + 7px/6);
  margin-right: calc(0px + 7px/6);
  width: 14.11429%;
  width: -moz-calc(100%/7 - 1px);
  width: -o-calc(100%/7 - 1px);
  width: -webkit-calc(100%/7 - 1px);
  width: calc(100%/7 - 1px);
  height: 100%;
  display: inline-block;
  position: relative;
}

.calendar .c-holder .c-grid .c-row .c-day.c-l .date-holder {
  font-size: 1em;
}

.calendar .c-holder .c-grid .c-row .c-day:last-child {
  margin-right: 0;
}

.calendar .c-holder .c-grid .c-row .c-day.have-events {
  cursor: pointer;
}

.calendar .c-holder .c-grid .c-row .c-day.have-events:hover {
  background-color: #232323;
}

.calendar .c-holder .c-grid .c-row .c-day.other-month {
  color: #373737;
}

.calendar .c-holder .c-grid .c-row .c-day.other-month.have-events:hover {
  color: white;
}

.calendar .c-holder .c-grid .c-row .c-day.this-day {
  background: none;
}

.calendar .c-holder .c-grid .c-row .c-day .date-holder {
  font-size: 1.3em;
  position: absolute;
  right: 5%;
  bottom: 5%;
}

.calendar .c-holder .c-grid .c-row .c-day .event-n-holder {
  height: 90%;
  height: -moz-calc(100% - 10px);
  height: -o-calc(100% - 10px);
  height: -webkit-calc(100% - 10px);
  height: calc(100% - 10px);
  left: 5%;
  left: -moz-calc(0px + 5px);
  left: -o-calc(0px + 5px);
  left: -webkit-calc(0px + 5px);
  left: calc(0px + 5px);
  top: 5%;
  top: -moz-calc(0px + 5px);
  top: -o-calc(0px + 5px);
  top: -webkit-calc(0px + 5px);
  top: calc(0px + 5px);
  position: absolute;
  width: 0.25em;
}

.calendar .c-holder .c-grid .c-row .c-day .event-n-holder .event-n {
  height: 0.5em;
  background-color: white;
  width: 100%;
  margin: 1px 0;
  padding: 5px;
}

.calendar .c-specific {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  display: none;
  padding: 1em;
}

.calendar .c-specific .specific-day {
  width: 30%;
  display: inline-block;
  padding-bottom: 1em;
  cursor: pointer;
}

.calendar .c-specific .specific-day:hover {
  background: #232323;
}

.calendar .c-specific .specific-day [i=day] {
  font-size: 3em;
  text-align: center;
}

.calendar .c-specific .specific-day [i=month] {
  font-size: 2em;
  line-height: 0.5em;
  text-align: center;
}

.calendar .c-specific .s-scheme {
  display: inline-block;
  height: 100%;
  margin-left: 1em;
  width: 60%;
  width: -moz-calc(70% - 1em);
  width: -o-calc(70% - 1em);
  width: -webkit-calc(70% - 1em);
  width: calc(70% - 1em);
  overflow-y: scroll;
  text-align: left;
}

.calendar .c-specific .s-scheme::-webkit-scrollbar {
  width: 10px;
}

.calendar .c-specific .s-scheme::-webkit-scrollbar-track {
  background: transparent;
}

.calendar .c-specific .s-scheme::-webkit-scrollbar-thumb {
  background: #232323;
}

.calendar .c-specific .s-scheme .s-event {
  padding: 0.5em;
  margin: 0.5em 0;
}

.calendar .c-specific .s-scheme .s-event:first-child {
  margin-top: 0;
}

.calendar .c-specific .s-scheme .s-event:last-child {
  margin-bottom: 0;
}

.calendar .c-specific .s-scheme .s-event h1 {
  margin: 0 0 10px 0;
  font-size: 1.6em;
  line-height: 1;
  font-weight: 400;
}

.calendar .c-specific .s-scheme .s-event p {
  margin: 0;
}

.calendar .c-specific .s-scheme .s-event p[data-role=loc] {
  line-height: 1;
}

.calendar:hover .c-month-view {
  background: #232323 !important;
}

.calendar:hover .c-month-view .c-month-arrow {
  color: white;
}

.calendar.spec-day .c-grid {
  display: none;
}

.calendar.spec-day .c-specific {
  display: block;
}

.calendar.spec-day .c-month-arrow {
  display: none;
}

.calendar[data-showdays=false] .c-holder .c-grid .c-row {
  height: 15.66667%;
  height: -moz-calc(100%/6 - 7px/6);
  height: -o-calc(100%/6 - 7px/6);
  height: -webkit-calc(100%/6 - 7px/6);
  height: calc(100%/6 - 7px/6);
}

.calendar-day-back { 
  font-size:25px;
  position:absolute;
  top:20px;
  left:20px;
}

.calendar-map {
  padding-top: 10px;
}

.calendar-map-icon {
  margin-top: 5px;
}

.calendar-map-link {
  color: #ffffff;
}

[data-color=red] {
  background-color: #E83C2C;
}

[data-color=red] .c-month-view,[data-color=red] .c-day,[data-color=red] .specific-day,[data-color=red] .s-event {
  background-color: #C1291B;
}

[data-color=blue] {
  background-color: #2497DB;
}

[data-color=blue] .c-month-view,[data-color=blue] .c-day,[data-color=blue] .specific-day,[data-color=blue] .s-event {
  background-color: #3081B9;
}

[data-color=green] {
  background-color: #2ECC70;
}

[data-color=green] .c-month-view,[data-color=green] .c-day,[data-color=green] .specific-day,[data-color=green] .s-event {
  background-color: #28AE61;
}

[data-color=yellow] {
  background-color: #F2C30F;
}

[data-color=yellow] .c-month-view,[data-color=yellow] .c-day,[data-color=yellow] .specific-day,[data-color=yellow] .s-event {
  background-color: #F39C12;
}

body,html {
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: 300;
}

* {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
  -webkit-tap-highlight-color: transparent;
  vertical-align: top;
}

div#onpagenavigation {
  display: none;
  position: fixed;
  right: .5em;
  top: 5em;
  opacity: 0.5;
  -webkit-transition: opacity 0.5s;
  -moz-transition: opacity 0.5s;
  transition: opacity 0.5s;
}

div#onpagenavigation.active {
  opacity: 1;
}

div#onpagenavigation ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

div#onpagenavigation ul li {
  text-align: right;
  padding: 0.2em 0;
  border-right: 0.2em transparent solid;
  padding-right: 0.2em;
  -webkit-transition: border 0.5s;
  -moz-transition: border 0.5s;
  transition: border 0.5s;
}

div#onpagenavigation ul li.active {
  border-right-color: #e62d2d;
}

@media (min-width: 50em) {
  div#onpagenavigation {
    display: block;
  }
}

.wrapperhl {
  margin-top: 5em;
  font-weight: normal;
  font-size: 0.9em;
  font-style: italic;
  text-align: center;
  margin-bottom: 0.5em;
}

.wrapperhl+[class^=wrapper-] {
  margin-top: 0.5em;
}

[class^=wrapper-] {
  background-color: white;
  border-left: 0.3em #e62d2d solid;
  margin: auto;
  margin-top: 1em;
  padding: 1em;
  font-size: 1.1em;
}

[class^=wrapper-] h1,[class^=wrapper-] h2,[class^=wrapper-] h3,[class^=wrapper-] h4,[class^=wrapper-] h5,[class^=wrapper-] h6,[class^=wrapper-] p,[class^=wrapper-] span {
  margin: 0;
  margin-top: 0.2em;
}

[class^=wrapper-] h1:first-child,[class^=wrapper-] h2:first-child,[class^=wrapper-] h3:first-child {
  margin-top: 0;
  font-size: 1.2em;
}

[class^=wrapper-] p {
  margin-top: 0.4em;
}

[class^=wrapper-] div.quote {
  padding: 0.5em;
  margin-top: 1em;
  background-color: #e62d2d;
  color: white;
  width: 100%;
  width: -moz-calc(100% + 2em);
  width: -o-calc(100% + 2em);
  width: -webkit-calc(100% + 2em);
  width: calc(100% + 2em);
  margin-left: 0;
  margin-left: -moz-calc(0px - 1em);
  margin-left: -o-calc(0px - 1em);
  margin-left: -webkit-calc(0px - 1em);
  margin-left: calc(0px - 1em);
}

[class^=wrapper-] p.quoted {
  margin-top: 0;
  text-align: right;
  font-size: 0.9em;
}

[class^=wrapper-] p.quoted[data-first] {
  margin-top: 0.8em;
}

section.contact-form-s input[type=text],section.contact-form-s input[type=email],section.contact-form-s input[type=password],section.contact-form-s input[type=search],section.contact-form-s input[type=tel],section.contact-form-s textarea {
  width: 100%;
}

@media (min-width: 35em) {
  section.contact-form-s input[type=text],section.contact-form-s input[type=email],section.contact-form-s input[type=password],section.contact-form-s input[type=search],section.contact-form-s input[type=tel],section.contact-form-s textarea {
    width: 47.5%;
    margin-left: 5%;
  }

  section.contact-form-s input[type=text][alpha],section.contact-form-s input[alpha][type=email],section.contact-form-s input[alpha][type=password],section.contact-form-s input[alpha][type=search],section.contact-form-s input[alpha][type=tel],section.contact-form-s textarea[alpha] {
    margin-left: 0;
  }

  section.contact-form-s textarea {
    width: 100%;
    margin-left: 0;
  }
}

.wrapper-20 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-20 {
    width: 40%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-20 {
    width: 30%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-20 {
    width: 20%;
  }
}

.wrapper-30 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-30 {
    width: 60%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-30 {
    width: 45%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-30 {
    width: 30%;
  }
}

.wrapper-40 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-40 {
    width: 80%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-40 {
    width: 60%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-40 {
    width: 40%;
  }
}

.wrapper-50 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-50 {
    width: 100%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-50 {
    width: 75%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-50 {
    width: 50%;
  }
}

.wrapper-60 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-60 {
    width: 120%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-60 {
    width: 90%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-60 {
    width: 60%;
  }
}

.wrapper-70 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-70 {
    width: 140%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-70 {
    width: 105%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-70 {
    width: 70%;
  }
}

.wrapper-80 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-80 {
    width: 160%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-80 {
    width: 120%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-80 {
    width: 80%;
  }
}

.wrapper-90 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
}

@media (min-width: 40em) {
  .wrapper-90 {
    width: 180%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapper-90 {
    width: 135%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapper-90 {
    width: 90%;
  }
}

.wrapperclear-20 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-20 {
    width: 40%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-20 {
    width: 30%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-20 {
    width: 20%;
  }
}

.wrapperclear-30 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-30 {
    width: 60%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-30 {
    width: 45%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-30 {
    width: 30%;
  }
}

.wrapperclear-40 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-40 {
    width: 80%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-40 {
    width: 60%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-40 {
    width: 40%;
  }
}

.wrapperclear-50 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-50 {
    width: 100%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-50 {
    width: 75%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-50 {
    width: 50%;
  }
}

.wrapperclear-60 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-60 {
    width: 120%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-60 {
    width: 90%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-60 {
    width: 60%;
  }
}

.wrapperclear-70 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-70 {
    width: 140%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-70 {
    width: 105%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-70 {
    width: 70%;
  }
}

.wrapperclear-80 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-80 {
    width: 160%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-80 {
    width: 120%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-80 {
    width: 80%;
  }
}

.wrapperclear-90 {
  width: 90%;
  width: -moz-calc(100% - 2em);
  width: -o-calc(100% - 2em);
  width: -webkit-calc(100% - 2em);
  width: calc(100% - 2em);
  margin: auto;
  margin-top: 1em;
}

@media (min-width: 40em) {
  .wrapperclear-90 {
    width: 180%;
    max-width: 90%;
  }
}

@media (min-width: 50em) {
  .wrapperclear-90 {
    width: 135%;
    max-width: 90%;
  }
}

@media (min-width: 60em) {
  .wrapperclear-90 {
    width: 90%;
  }
}

label {
  font-size: 0.8em;
  font-weight: bold;
  margin-top: 0.5em;
  opacity: 0;
  display: block;
  -webkit-transition: opacity 0.5s;
  -moz-transition: opacity 0.5s;
  transition: opacity 0.5s;
}

label.active {
  opacity: 1;
}

label:first-child {
  margin-top: 0;
}

label+input[type=text],label+input[type=email],label+input[type=password],label+input[type=search],label+input[type=tel],label+textarea {
  margin-top: 0.2em;
}

.color {
  height: 5em;
  width: 20%;
  display: inline-block;
  margin-left: 6.6%;
}

.color:first-child {
  margin-left: 0;
}

.color-inset {
  height: 50%;
  padding: .5em;
  text-align: center;
  color: white;
}
</style>
<?php
  }
?>