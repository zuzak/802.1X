<?php
include "main.php";
?><!DOCTYPE html>
<!-- this is terrible code from first year, don't judge me thanks -->
<html>
	<head>
		<title>Connecting to Central</title>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="guide.css">
	</head>
	<body>
        <a href="https://github.com/zuzak/screen-tutorial"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
		<h1>How to get a persistent IRC session</h1>
        <p>
            This tutorial is made up of three parts: getting an SSH session
            running, getting a <span class="command">screen</span> session running,
            and getting <span class="command">irssi</span> running.
        </p>
		<div id="ssh">
			<h2>SSH</h2>
            <p>
				<abbr title="Secure SHell">SSH</abbr> is a protocol, related to
				Telnet, used to securely communicate over an insecure network.
				It's pretty cool.
			</p>
			<h3>SSH on *nix</h3>
			<ol id="ssh-unix">
				<li>
					It's fairly easy to get an SSH session running on *nix.
					Just open your favourite terminal and type your Aber
					username followed by the address of Central:
					<pre class="command"><span class="prompt">$</span> <span class="command">ssh</span> <?php echo $user ?>@central.aber.ac.uk</pre>
					<?php if ( $onstunet == true ) {
						echo "As you are currently on Stunet, and because Aberystwyth's <abbr title=\"Domain Name System\">DNS</abbr> servers will add the suffix for you, one can simply type: <pre class=\"command\"><span class=\"prompt\">\$</span> <span class=\"command\">ssh</span> $user@central</pre>";
					} ?>
				</li>
			</ol>
			<h3>SSH on Windows</h3>
			<ol id="ssh-win">
				<li>
					Getting SSH working on Windows is more involved than on
					Unix based systems, as Windows doesn't support SSH out of
					the box. Instead, one needs to use PuTTY (although
					alternatives exist).
				</li>
				<li>
					Download either the original, tried and tested
					<a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/">PuTTY</a>,
					or the more advanced <a href="https://puttytray.goeswhere.com/">PuTTY-Tray</a>,
					which includes clickable links.
				</li>
				<li>
					Run <span class="command">putty.exe</span>.
					In the server box, type <span class="command"><?php echo $user ?>@central<?php if ( $onstunet == false ) { echo ".aber.ac.uk"; } ?></span>, and click connect.
				</li>
				<li>
					It's worth mentioning that PuTTY is highly customisable,
					and that many of its useful settings are off by default.
					For example, you can use a UTF-8 compatible terminal or
					have it full screen. Fiddle around with the settings until
					you find a configuration you like.
				</li>
			</ol>
		</div>
		<div id="rest">
		<h2>Screen</h2>
		<ol id="cen">
			<li>
				Now you are connected to Central, you are now able to type
				<span class="command">irssi</span> to connect to IRC. However,
				that session will be lost as soon as you disconnect from the
				server&mdash;it's much better to use a persistent program such
				as <span class="command">tmux</span> or
				<span class="command">screen</span>. In this section of the
				tutorial, you will learn the basics of
				<span class="command">screen</span>, although it is worth having a go at
				<span class="command">tmux</span> at some point (but it requires
				compilation on central).
			</li>

			<li>
				It is very easy to get <span class="command">screen</span> running for the first time. Just type:
				<pre class="command"><span class="prompt">$</span> <span class="command">screen</span></pre>
			</li>
			<li>
				Now, whatever you do inside <span class="command">screen</span> will be persistent between sessions. To detach and return to the normal bash tty, type CTRL+A followed by D (<span class="command">^a c</span>).
			<li>
				To reattach to <span class="command">screen</span>, you should use:
				<pre class="command"><span class="prompt">$</span> <span class="command">screen</span> -dr</pre>
				This detaches any screen sessions you may have left running elsewhere, and then reattaches you to it.
			</li>
			<li>
				Accidentally running <span class="command">screen</span> when you already have a session can result in multiple sessions&mdash;don't do that! Use <span class="command">^a K</span> (CTRL+A, SHIFT+K) to kill a session entirely (or, more technically, a window).
			</li>
		</ol>
		<h2>irssi</h2>
		<ol>
			<li>
				Once you are inside your <span class="command">screen</span> session, get an IRC client open:
				<pre class="command"><span class="prompt">#</span> <span class="command">irssi</span> -c chat.freenode.net</pre>
			</li>
			<li>
				An IRC client should open and should connect to freenode.
			</li>
			<li>
				To change your nickname, type:
				<pre class="command">/nick swordfish</pre>
			</li>
			<li>
				It is best practice to register your nickname the first time you use it, to make it more difficult for other users to impersonate you.
				<pre class="command">/msg NickServ REGISTER <span class="edit">swordfish <?php echo $passwords[$password]; ?> youremail@example.com</span></pre>
				You should then associate yourself with your identity every time you connect to the server with:
				<pre class="command">/msg NickServ IDENTIFY <?php echo $passwords[$password]; ?></pre>
				Note that if you use a nickname someone else has already registered, you might be forced to rename to a weird nickname (like Guest12345).
				If that happens, you should pick a new nickname. If you own it, take a look at:
				<pre class="command">/msg Nickserv HELP RECOVER</pre>
			</li>
			<li>
				Finally, you can join a channel and start chatting. Channels (i.e. "rooms") on IRC generally begin with a #, with a few exceptions.
				<pre class="command">/join #abercs</pre>
			</li>
			<li>
				If you are getting connection errors to freenode, it might be
				because too many people are connecting at once. CS students might
				wish to try connecting through other DCS machines:
					<pre class="command">
ssh <?php echo $user; ?>@minted.dcs.aber.ac.uk
ssh <?php echo $user; ?>@wiked.dcs.aber.ac.uk
ssh <?php echo $user; ?>@ystwyth.aber.ac.uk
					</pre>
			</li>
		</ol>
		<h2>Advanced</h2>
		<ul>
			<li>
				If someone has already registered your nickname, you might be
				forced to rename to a name like "Guest1234". Usually, you'll
				need to pick a new nickname instead. Sorry.
			</li>
			<li>
				You might want to use SSL to connect to freenode.
				Take a look at <a href="https://wiki.archlinux.org/index.php/Irssi#SSL_Connection">the Arch Wiki</a>
				for good instructions on how to do this. If you feel like being
				extra secure, take a look at the client certificates as well: it
				lets you authenticate to the network without sending your password
				at all.
			</li>
			<li>
				Not sure who someone on IRC is? Users connecting from Central will,
				by default, show you their real name if you ask them to:
				<pre class="command">/whois timbl</pre>
			</li>
			<li>
				If you're in multiple channels, switch to them using Alt+1, Alt+2,
				et cetera. If Alt doesn't work, try using Esc instead.
			</li>
		</div>
	</body>
</html>
