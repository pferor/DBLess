<?php
$AUTHOR  = 'admin';
$CLOSED  = 'closed';
$TAGS    = '';
$TITLE   = 'Welcome to DBLess';
$SUMMARY = 'Getting started';
$POST    = '<p>
This project is incomplete: Perms. problems yet to solve, feeds and some comments and users features are in the <em>TODO</em> list.
<br>
<strong>This project is no longer continued</strong>. Its only purpose was to understand some PHP concepts.
</p>

<!-- more -->

<h4>Quick start</h4>
<p>
First of all, you need an administrator account. There is one:
</p>

<ul>
  <li>Username: <strong>admin</strong></li>
  <li>Password: <strong>pass</strong></li>
</ul>

<p>
You <span class="underline">must</span> change the password in the preferences page after logging in. When you are logged in, an administration button will appear at the top of the page. There you can add, edit or remove posts, moderate comments and manage users.
</p>

<p>
Make sure that the directories permissions are OK, so <em>DBLess</em> can write on them.
</p>

<h4>Users</h4>
<p>
New users can create an account in the <a href="?pg=join">join form</a>. All users created will be regular users and their accounts are needed only to make any comments showing some identity (nickname).
</p>

<h5>Creating an aministrator</h5>
<p>
All administrators have the same privileges. This site was intented to be a only-one-administrator site. To create a new administator you need to create the user in the regular form, and then add his/her username to the administrators names array in <tt>conf/site_admin.php</tt>.
</p>

<h4>Languages</h4>
<p>
The posts are saved on its own language folder, so if you add a new post in English, the post will be saved in <tt>posts/en/</tt> and will not be able to be seen from another language. If you want to run this site in more than one language you have to create a post for each language.
</p>

<h5>Adding a new language to the site</h5>
<p>
In order to add languages to the site so you can use it in a multilingual mode, you need three things:
</p>

<ul>
  <li>A language file stored in <tt>langs/frontend/&lt;language_code&gt;/</tt></li>
  <li>A language file stored in <tt>langs/backend/&lt;language_code&gt;/</tt></li>
  <li>A directory where to save the new incoming posts in <tt>posts/&lt;language_code&gt;</tt></li>
</ul>

<h5>Removing a language from your site</h5>
<p>
If you want to remove a language from your site, it will be enough removing the directory: <tt>posts/&lt;language_code&gt;</tt>. You don&#039;t need to remove the language file in <tt>langs/</tt>. It can stay there for a future use.
</p>

<p>
When you access to your site in a language, the interface language will change too. If you enter in the administration in English, it&#039;s the administration for the English posts only.
</p>';
?>
