-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2014 at 03:30 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `stylable`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `task` text NOT NULL,
  `element` varchar(100) NOT NULL,
  `property` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `html` text NOT NULL,
  `points` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `element`, `property`, `value`, `html`, `points`) VALUES
(1, 'Make the mouse cursor a pointer for #clickMeBut', '#clickMeBut', 'cursor', 'pointer', '<button id="clickMeBut">Click Me</button>', 10),
(2, 'Get rid of the bullets in the #groceryList', '#groceryList', 'list-style-type', 'none', '			<ul id="groceryList">\n				<h3>Grocery List</h3>\n				<li>2% Milk</li>\n				<li>Paper Towels</li>\n				<li>Butter</li>\n				<li>Rye Bread</li>\n				<li>Orange Juice</li>\n				<li>Sirloin Steak</li>\n				<li>Dozen Eggs</li>\n			</ul>', 10),
(3, 'In the #songTable, give each even row a background with this hex value: #74F5AC', '#songTable tr:nth-child(even)', 'background-color', 'rgb(116, 245, 172)', '			<table id="songTable">\n				<tr>\n					<th>Title</th>\n					<th>Artist</th> \n					<th>Album</th>\n				</tr>\n				<tr>\n					<td>Happy</td>\n					<td>Pharrell Williams</td> \n					<td>Girl</td>\n				</tr>\n				<tr>\n					<td>All of Me</td>\n					<td>John Legend</td>\n					<td>Love In the Future</td>\n				</tr>\n				<tr>\n					<td>Dark Horse</td>\n					<td>Katy Perry</td>\n					<td>Prism</td>\n				</tr>\n				<tr>\n					<td>Pompeii</td>\n					<td>Bastille</td>\n					<td>Bad Blood</td>\n				</tr>\n				<tr>\n					<td>Royals</td>\n					<td>Lorde</td>\n					<td>Pure Heroine</td>\n				</tr>\n			</table>', 50),
(4, 'Shrink the width of #genieImg down to 150 pixels.', '#genieImg', 'width', '150px', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="genieImg" src="img/genie.jpg" alt="Genie in a Bottle" />\n\n			</div>', 15),
(5, 'The user forgot their email in the #signUpForm!  Let them know by changing the email fields'' border color to #FFB586', '#signUpForm input[type=email]', 'border-color', 'rgb(255, 181, 134)', '			<form id="signUpForm">\n\n				<input type="text" placeholder="First Name" > <br />\n\n				<input type="text" placeholder="Last Name" > <br />\n\n				<input type="email" placeholder="Email Address" > <br />\n\n				<button type="button">Submit</button>\n\n\n			</form>', 45),
(6, 'There''s something up with the font in the #newsSection!  Change it to ''Roboto''', '#newsSection', 'font-family', 'Roboto', '			<section id="newsSection">\n\n				<article>\n					Dessert icing powder lemon drops jelly-o topping halvah donut. Chupa chups pie donut sweet pie oat cake candy chupa chups. Dessert cupcake cake bonbon wafer. Cake chocolate cake gingerbread gingerbread muffin cotton candy cupcake. Chocolate cake applicake muffin gummi bears. Oat cake gummies danish cotton candy. Sweet jelly-o tiramisu lemon drops.\n				</article>\n\n				<article>\n					Macaroon sugar plum bonbon carrot cake. Sesame snaps pie wafer pudding chocolate cake chupa chups ice cream macaroon gingerbread. Biscuit oat cake sugar plum biscuit. Sugar plum cookie donut lemon drops jelly-o lollipop chupa chups. Apple pie jelly beans pastry pudding brownie powder. Dragee gummies candy canes cheesecake chupa chups. Gummies danish caramels marshmallow apple pie.\n				</article>\n\n				<article>\n					Chocolate cake tootsie roll caramels cupcake. Applicake candy canes marzipan biscuit brownie. Bonbon jelly beans jelly-o unerdwear.com muffin biscuit cotton candy. Carrot cake sweet marshmallow. Cookie chocolate pie donut liquorice jelly. Fruitcake dragee marzipan gummies cake chocolate muffin brownie. Cookie halvah cake gummies lollipop.\n				</article>\n\n\n			</section>', 15),
(7, 'Let''s make the first link of each paragraph in #linksDiv stand out.  Make them white!', '#linksDiv a:first-child', 'color', 'rgb(255, 255, 255)', '			<div id="linksDiv">\n\n				<p>\n					Chocolate bar fruitcake unerdwear.com sugar plum dessert jelly. Cookie sweet roll candy canes gingerbread cupcake icing lemon drops cotton candy jelly-o. Fruitcake icing pie chocolate cake. Jelly-o sugar plum donut dessert apple pie. Souffle tiramisu ice cream. Chupa chups jelly muffin bonbon oat cake candy canes <a href="https://teamtreehouse.com">Team Treehouse</a> brownie. Sweet danish pastry chupa chups powder muffin unerdwear.com icing. Lemon drops sweet roll candy canes jelly beans brownie bear claw gummi bears croissant. Jujubes chocolate cake powder. Marshmallow <a href="http://css-tricks.com/">CSS Tricks</a> sweet marshmallow icing lollipop cookie souffle. Chupa chups pie croissant souffle halvah. Chupa chups carrot cake cotton candy sesame snaps croissant chupa chups fruitcake dragee. Fruitcake jelly-o topping cheesecake lemon drops bonbon sweet roll danish. Gummies cookie muffin carrot cake cotton candy brownie jelly beans brownie jujubes.\n				</p>\n\n				<p>\n					Macaroon chocolate cake <a href="http://tympanus.net/codrops/">Codrops</a> bear claw cheesecake. Macaroon apple pie danish chocolate bar. Sugar plum jujubes fruitcake wafer marshmallow candy cookie. Pastry pastry marzipan brownie chupa chups tart jujubes. Cake oat cake cotton candy gummi bears <a href="https://developer.mozilla.org/en-US/docs/Web/CSS">Mozilla Developer Network</a> sweet roll donut muffin chocolate cake. Liquorice muffin bonbon tart. Pastry pudding croissant dragee jelly-o jelly beans. Caramels toffee souffle tootsie roll. Pastry marzipan jelly <a href="http://www.css3files.com/">CSS3 Files</a> beans chocolate cake wafer candy danish lemon drops macaroon. Macaroon gummies caramels tiramisu tiramisu. Pudding powder marzipan lemon drops candy macaroon jelly beans cake candy canes. Muffin lemon drops tart caramels.\n				</p>\n\n			</div>', 30),
(10, 'Let''s make #megamindImg smarter by increasing his height to 300 pixels', '#megamindImg', 'height', '300px', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="megamindImg" src="img/megamind.jpg" alt="Megamind the Good Villain" />\n\n			</div>', 35),
(12, 'Emperor Zurg is bad. Let''s get rid of him by not displaying #zurgImg', '#zurgImg', 'display', 'none', '			<div class="taskImgContainer">\r\n				<img id="zurgImg" class="taskImg" src="img/zurg.jpg" alt="Walle the Robot" />\r\n			</div>', 10),
(13, 'Let''s make this witch fade away by bringing #witchImg''s opacity down to 0', '#witchImg', 'opacity', '0', '			<div class="taskImgContainer">\n				<img id="witchImg" class="taskImg" src="img/witch.jpg" alt="Old Hag" />\n			</div>', 10),
(14, 'Let''s give #vertNav''s li tags a larger font.  How about 1.5em''s', '#vertNav li', 'font-size', '36px', '			<ul id="vertNav">\r\n				<li><i class="icon-shop"></i> Home</li>\r\n				<li><i class="icon-pen2"></i> Projects</li>\r\n				<li><i class="icon-user"></i> About</li>\r\n				<li><i class="icon-mail"></i> Contact</li>\r\n			</ul>', 20),
(15, 'We''re currently on the home page.  Tell the user this by setting #horizNav''s first list item to have a 3 pixel solid white border on the bottom', '#horizNav li:first-child', 'border-bottom', '3px solid rgb(255, 255, 255)', '			<ul id="horizNav">\r\n				<li><i class="icon-shop"></i></li>\r\n				<li><i class="icon-stack"></i></li>\r\n				<li><i class="icon-calendar"></i></li>\r\n				<li><i class="icon-settings"></i></li>\r\n			</ul>', 30),
(16, 'The body''s background is too green...Let''s change it to #FFB586', 'body', 'background-color', 'rgb(255, 181, 134)', '<i id="bodyHeart" class="icon-heart"></i>', 10),
(17, 'The style element at the bottom of the window is too dark, lets lighten it up with a #FFB586 color for the background', 'style', 'background-color', 'rgb(255, 181, 134)', '<i id="styleBulb" class="icon-bulb"></i>', 20),
(18, 'This citation doesn''t look right.  Let''s give the cite tag inside #ipsumQuote 60 pixels of padding on the left', '#ipsumQuote cite', 'padding-left', '60px', '			<blockquote id="ipsumQuote"> \n				<p>\n					Icing danish tart oat cake tart pudding toffee brownie dragee. Chupa chups bonbon sweet roll chocolate cake bear claw lollipop caramels donut. Wafer apple pie lollipop fruitcake unerdwear.com chocolate cake.\n				</p>\n				<cite>- Cupcake Ipsum  <a href="http://www.cupcakeipsum.com/" target="_blank">April 14, 2014</a></cite>  \n			</blockquote>', 55),
(19, 'Because you like Stylable so much, let''s increase #likeIcon''s size to 5em''s.', '#likeIcon', 'font-size', '80px', '<i id="likeIcon" class="icon-like"></i>', 15),
(20, '#figLorax''s figcaption is tough to see.  Give its font a weight of 300', '#figLorax figcaption', 'font-weight', '300', '			<figure class="taskImgContainer" id="figLorax">\n				<img class="taskImg" src="img/lorax.jpg" alt="The Lorax">\n				<figcaption>Figure 1. A candid shot of the Lorax caught in the wild</figcaption>\n			</figure>', 30),
(21, '#russelImg can''t wait.  He wants to float his way to the left of the window now.', '#russelImg', 'float', 'left', '			<div class="taskImgContainer">\r\n				<img id="russelImg" class="taskImg" src="img/russel.jpg" alt="Russel the Boy Scout" />\r\n			</div>', 40),
(22, 'Give the even images inside .taskImgContainer dashed borders', '.taskImgContainer img:nth-child(even)', 'border-style', 'dashed', '			<div class="taskImgContainer">\r\n				<img class="taskImg imgSmall" id="bruceImg" src="img/bruce.jpg" alt="Bruce the Shark" />\r\n				<img class="taskImg imgSmall" id="zurgImg" src="img/zurg.jpg" alt="Emperor Zurg" />\r\n				<br />\r\n				<img class="taskImg imgSmall" id="walleImg" src="img/walle.jpg" alt="Wall-e the Robot" />\r\n				<img class="taskImg imgSmall" id="simbaImg" src="img/simba.jpg" alt="Simba the Lion King" />\r\n			</div>', 55),
(23, 'Give #walleImg a circular head by changing his borders'' radius to 50%', '#walleImg', 'border-radius', '50%', '			<div class="taskImgContainer">\r\n				<img class="taskImg" id="walleImg" src="img/walle.jpg" alt="Wall-e the Robot" />\r\n			</div>', 25),
(24, 'The third .stopLightBulb is causing a traffic jam! Change its color to #6EE8A3', '.stopLightBulb:nth-child(3)', 'background-color', 'rgb(110, 232, 163)', '			<div id="stoplightContainer">\r\n				<button class="stopLightBulb"></button>\r\n				<button class="stopLightBulb"></button>\r\n				<button class="stopLightBulb"></button>\r\n			</div>', 65),
(25, 'Minion doesn''t like his #minionPants. Let''s make them invisible by displaying them as none', '#minionPants', 'display', 'none', '			<div id="minionContainer">\r\n				<div id="minionBand"></div>\r\n				<div id="minionGlasses">\r\n					<div id="minionEye"></div>\r\n				</div>\r\n				<div id="minionMouth"></div>\r\n				<div id="minionPants"></div>\r\n			</div>', 15),
(26, 'The second .graphBar in .graphContainer isn''t tall enough.  Make it 240 pixels high', '.graphContainer .graphBar:nth-child(2)', 'height', '240px', '			<div class="graphContainer">\r\n				<div class="graphBar"></div>\r\n				<div class="graphBar"></div>\r\n				<div class="graphBar"></div>\r\n				<div class="graphBar"></div>\r\n				<div class="graphBar"></div>\r\n			</div>', 75);
