{* purpose of this template: extensions rss feed *}
{assign var='lct' value='user'}
{if isset($smarty.get.lct) && $smarty.get.lct eq 'admin'}
    {assign var='lct' value='admin'}
{/if}
{museoTemplateHeaders contentType='application/rss+xml'}<?xml version="1.0" encoding="{charset assign='charset'}{if $charset eq 'ISO-8859-15'}ISO-8859-1{else}{$charset}{/if}" ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:atom="http://www.w3.org/2005/Atom">
{*<rss version="0.92">*}
{gt text='Latest extensions' assign='channelTitle'}
{gt text='A direct feed showing the list of extensions' assign='channelDesc'}
    <channel>
        <title>{$channelTitle}</title>
        <link>{$baseurl|escape:'html'}</link>
        <atom:link href="{php}echo substr(\System::getBaseUrl(), 0, strlen(\System::getBaseUrl())-1);{/php}{getcurrenturi}" rel="self" type="application/rss+xml" />
        <description>{$channelDesc} - {$modvars.ZConfig.slogan}</description>
        <language>{lang}</language>
        {* commented out as $imagepath is not defined and we can't know whether this logo exists or not
        <image>
            <title>{$modvars.ZConfig.sitename}</title>
            <url>{$baseurl|escape:'html'}{$imagepath}/logo.jpg</url>
            <link>{$baseurl|escape:'html'}</link>
        </image>
        *}
        <docs>http://blogs.law.harvard.edu/tech/rss</docs>
        <copyright>Copyright (c) {php}echo date('Y');{/php}, {$baseurl}</copyright>
        <webMaster>{$modvars.ZConfig.adminmail|escape:'html'} ({usergetvar name='uname' uid=2})</webMaster>

{foreach item='extension' from=$items}
    <item>
        <title><![CDATA[{if isset($extension.updatedDate) && $extension.updatedDate ne null}{$extension.updatedDate|dateformat} - {/if}{$extension->getTitleFromDisplayPattern()|notifyfilters:'museo.filterhook.extensions'}]]></title>
        <link>{modurl modname='MUSeo' type=$lct func='view' ot='extension' fqurl=true}</link>
        <guid>{modurl modname='MUSeo' type=$lct func='view' ot='extension' fqurl=true}</guid>
        {if isset($extension.createdUserId)}
            {usergetvar name='uname' uid=$extension.createdUserId assign='cr_uname'}
            {usergetvar name='name' uid=$extension.createdUserId assign='cr_name'}
            <author>{usergetvar name='email' uid=$extension.createdUserId} ({$cr_name|default:$cr_uname})</author>
        {/if}

        <description>
            <![CDATA[
            {$extension.name|replace:'<br>':'<br />'}
            ]]>
        </description>
        {if isset($extension.createdDate) && $extension.createdDate ne null}
            <pubDate>{$extension.createdDate|dateformat:"%a, %d %b %Y %T +0100"}</pubDate>
        {/if}
    </item>
{/foreach}
    </channel>
</rss>
