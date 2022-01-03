<?php
include_once (__DIR__ . "../../includes.php");

use Socketlabs\SocketLabsClient;
use Socketlabs\Message\EmailAddress;
use Socketlabs\Message\CustomHeader;
use Socketlabs\Message\Attachment;
use Socketlabs\Message\BasicMessage;

$client = new SocketLabsClient(exampleConfig::serverId(), exampleConfig::password());
//$client->proxyUrl = exampleConfig::proxy();  //Uncomment to configure a proxy such as fiddler

//Build the message
$message = new BasicMessage();
$message->subject = "Sending Basic Complex Example";

//Add different types of parties to the message
$message->from = new EmailAddress("from@example.com", "from");
$message->to[] = new EmailAddress("recipient@example.com", "recipient name");
$message->cc[] = new EmailAddress("cc@example.com", "cc name");
$message->bcc[] = new EmailAddress("bcc@example.com", "bcc name");

//Set reply to
$message->replyTo = new EmailAddress("replyto@example.com", "Reply Address");

//set html and text body parts
$message->htmlBody = "<body><p><strong>Lorem Ipsum</strong></p><br /><img src=\"cid:Bus\" /></body>";
$message->plainTextBody = "Lorem Ipsum";
$message->charset = "utf-8";

//Tag message with mailing and message ids.
//See https://support.socketlabs.com/index.php/Knowledgebase/Article/View/48/2/using-mailingcampaign-ids-and-message-ids-with-socketlabs-email-on-demand
$message->mailingId = "My Mailing Id"; //Identifier for groups of messages such as campaigns, jobs, or batches of messages.
$message->messageId = "My Message Id"; //Typically used to identify a specific message or a recipient of a message.

//Configure custom message headers
$message->customHeaders[] = new CustomHeader("MyMessageHeader", "I am a message header");

//Add an attachment. specify the cid as 'Bus' so it can be embedded
$attachment = Attachment::createFromPath( __DIR__."/../Img/Bus.png", "Bus.png", "IMAGE/PNG", "Bus");
$attachment->customHeaders[] = new CustomHeader("MyAttachmentHeader", "I am an attachment header");
$message->attachments[] = $attachment;

$response = $client->send($message);