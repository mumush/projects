-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 03:52 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `element`, `property`, `value`, `html`, `points`) VALUES
(1, 'Make the mouse cursor a pointer for #clickMeBut', '#clickMeBut', 'cursor', 'pointer', '<button id="clickMeBut">Click Me</button>', 10),
(2, 'Get rid of the bullets in the #groceryList', '#groceryList', 'list-style-type', 'none', '			<ul id="groceryList">\n				<h3>Grocery List</h3>\n				<li>2% Milk</li>\n				<li>Paper Towels</li>\n				<li>Butter</li>\n				<li>Rye Bread</li>\n				<li>Orange Juice</li>\n				<li>Sirloin Steak</li>\n				<li>Dozen Eggs</li>\n			</ul>', 10),
(3, 'In the #songTable, give each even row a background with this hex value: #74F5AC', '#songTable tr:nth-child(even)', 'background-color', 'rgb(116, 245, 172)', '			<table id="songTable">\n				<tr>\n					<th>Title</th>\n					<th>Artist</th> \n					<th>Album</th>\n				</tr>\n				<tr>\n					<td>Happy</td>\n					<td>Pharrell Williams</td> \n					<td>Girl</td>\n				</tr>\n				<tr>\n					<td>All of Me</td>\n					<td>John Legend</td>\n					<td>Love In the Future</td>\n				</tr>\n				<tr>\n					<td>Dark Horse</td>\n					<td>Katy Perry</td>\n					<td>Prism</td>\n				</tr>\n				<tr>\n					<td>Pompeii</td>\n					<td>Bastille</td>\n					<td>Bad Blood</td>\n				</tr>\n				<tr>\n					<td>Royals</td>\n					<td>Lorde</td>\n					<td>Pure Heroine</td>\n				</tr>\n			</table>', 50),
(4, 'Shrink the width of #genieImg down to 200 pixels.', '#genieImg', 'width', '200px', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="genieImg" src="img/genie.jpg" alt="Genie in a Bottle" />\n\n			</div>', 15),
(5, 'The user forgot their email in the #signUpForm!  Let them know by changing the email fields'' border color to #FFB586', '#signUpForm input[type=email]', 'border-color', 'rgb(255, 181, 134)', '			<form id="signUpForm">\n\n				<input type="text" placeholder="First Name" > <br />\n\n				<input type="text" placeholder="Last Name" > <br />\n\n				<input type="email" placeholder="Email Address" > <br />\n\n				<button type="button">Submit</button>\n\n\n			</form>', 45),
(6, 'There''s something up with the font in the #newsSection!  Change it to ''Roboto''', '#newsSection', 'font-family', 'Roboto', '			<section id="newsSection">\n\n				<article>\n					Dessert icing powder lemon drops jelly-o topping halvah donut. Chupa chups pie donut sweet pie oat cake candy chupa chups. Dessert cupcake cake bonbon wafer. Cake chocolate cake gingerbread gingerbread muffin cotton candy cupcake. Chocolate cake applicake muffin gummi bears. Oat cake gummies danish cotton candy. Sweet jelly-o tiramisu lemon drops.\n				</article>\n\n				<article>\n					Macaroon sugar plum bonbon carrot cake. Sesame snaps pie wafer pudding chocolate cake chupa chups ice cream macaroon gingerbread. Biscuit oat cake sugar plum biscuit. Sugar plum cookie donut lemon drops jelly-o lollipop chupa chups. Apple pie jelly beans pastry pudding brownie powder. Dragee gummies candy canes cheesecake chupa chups. Gummies danish caramels marshmallow apple pie.\n				</article>\n\n				<article>\n					Chocolate cake tootsie roll caramels cupcake. Applicake candy canes marzipan biscuit brownie. Bonbon jelly beans jelly-o unerdwear.com muffin biscuit cotton candy. Carrot cake sweet marshmallow. Cookie chocolate pie donut liquorice jelly. Fruitcake dragee marzipan gummies cake chocolate muffin brownie. Cookie halvah cake gummies lollipop.\n				</article>\n\n\n			</section>', 15),
(7, 'Let''s make the first link of each paragraph in #linksDiv stand out.  Make them white!', '#linksDiv a:first-child', 'color', 'rgb(255, 255, 255)', '			<div id="linksDiv">\n\n				<p>\n					Chocolate bar fruitcake unerdwear.com sugar plum dessert jelly. Cookie sweet roll candy canes gingerbread cupcake icing lemon drops cotton candy jelly-o. Fruitcake icing pie chocolate cake. Jelly-o sugar plum donut dessert apple pie. Souffle tiramisu ice cream. Chupa chups jelly muffin bonbon oat cake candy canes <a href="https://teamtreehouse.com">Team Treehouse</a> brownie. Sweet danish pastry chupa chups powder muffin unerdwear.com icing. Lemon drops sweet roll candy canes jelly beans brownie bear claw gummi bears croissant. Jujubes chocolate cake powder. Marshmallow <a href="http://css-tricks.com/">CSS Tricks</a> sweet marshmallow icing lollipop cookie souffle. Chupa chups pie croissant souffle halvah. Chupa chups carrot cake cotton candy sesame snaps croissant chupa chups fruitcake dragee. Fruitcake jelly-o topping cheesecake lemon drops bonbon sweet roll danish. Gummies cookie muffin carrot cake cotton candy brownie jelly beans brownie jujubes.\n				</p>\n\n				<p>\n					Macaroon chocolate cake <a href="http://tympanus.net/codrops/">Codrops</a> bear claw cheesecake. Macaroon apple pie danish chocolate bar. Sugar plum jujubes fruitcake wafer marshmallow candy cookie. Pastry pastry marzipan brownie chupa chups tart jujubes. Cake oat cake cotton candy gummi bears <a href="https://developer.mozilla.org/en-US/docs/Web/CSS">Mozilla Developer Network</a> sweet roll donut muffin chocolate cake. Liquorice muffin bonbon tart. Pastry pudding croissant dragee jelly-o jelly beans. Caramels toffee souffle tootsie roll. Pastry marzipan jelly <a href="http://www.css3files.com/">CSS3 Files</a> beans chocolate cake wafer candy danish lemon drops macaroon. Macaroon gummies caramels tiramisu tiramisu. Pudding powder marzipan lemon drops candy macaroon jelly beans cake candy canes. Muffin lemon drops tart caramels.\n				</p>\n\n			</div>', 30),
(8, 'Let''s make Bruce dizzy and rotate #bruceImg 360 degrees', '#bruceImg', 'transform', 'matrix(1, -0.00000000000000024492935982947064, 0.0', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="bruceImg" src="img/bruce.jpg" alt="Bruce the Shark" />\n\n			</div>', 75),
(9, 'Let''s flip Wall-e upside down.  Rotate #walleImg 180 degrees on the x-axis using transform!', '#walleImg', 'transform', 'rotateX(180deg)', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="walleImg" src="img/walle.jpg" alt="Wall-e the Robot" />\n\n			</div>', 75),
(10, 'Let''s make #megamindImg smarter by increasing his height to 300 pixels', '#megamindImg', 'height', '300px', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="megamindImg" src="img/megamind.jpg" alt="Megamind the Good Villain" />\n\n			</div>', 35),
(11, 'Simba wants to move 100 pixels down, do this by translating #simbaImg', '#simbaImg', 'transform', 'translate(100px)', '			<div class="taskImgContainer">\n\n				<img class="taskImg" id="simbaImg" src="img/simba.jpg" alt="Simba the Lion King" />\n\n			</div>', 80),
(12, 'Emperor Zurg is bad. Let''s get rid of him by not displaying #zurgImg', '#zurgImg', 'display', 'none', '			<div class="taskImgContainer">\r\n				<img id="zurgImg" class="taskImg" src="img/zurg.jpg" alt="Walle the Robot" />\r\n			</div>', 10),
(13, 'Let''s make this witch fade away by bringing #witchImg''s opacity down to 0', '#witchImg', 'opacity', '0', '			<div class="taskImgContainer">\r\n				<img id="witchImg" class="taskImg" src="img/witch.jpg" alt="Old Hag" />\r\n			</div>', 10),
(14, 'Let''s give #vertNav''s li tags a larger font.  How about 1.5em''s', '#vertNav li', 'font-size', '36px', '			<ul id="vertNav">\r\n				<li><i class="icon-shop"></i> Home</li>\r\n				<li><i class="icon-pen2"></i> Projects</li>\r\n				<li><i class="icon-user"></i> About</li>\r\n				<li><i class="icon-mail"></i> Contact</li>\r\n			</ul>', 20),
(15, 'We''re currently on the home page.  Tell the user this by setting #horizNav''s first list item to have a 3 pixel solid white border on the bottom', '#horizNav li:first-child', 'border-bottom', '3px solid rgb(255, 255, 255)', '			<ul id="horizNav">\r\n				<li><i class="icon-shop"></i></li>\r\n				<li><i class="icon-stack"></i></li>\r\n				<li><i class="icon-calendar"></i></li>\r\n				<li><i class="icon-settings"></i></li>\r\n			</ul>', 30);
