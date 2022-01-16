<?php
namespace Socketlabs;
/**
 * The response of an SocketLabsClient send request.
 */
class SendResponse{
    /**
     * The result of the SocketLabsClient send request.
     */
    public $result;

    /**
     * A unique key generated by the Injection API if an unexpected error occurs during the SocketLabsClient send request.
     * This unique key can be used by SocketLabs support to troubleshoot the issue.
     */
    public $transactionReceipt;

    /**
     * An array of AddressResult objects that contain the status of each address that failed. If no messages failed this array is empty.
     */
    public $addressResults = array();

    /**
     * Create a new instance of SendResponse
     * @param SendResult $result
     */
    public function __construct($result = null){
        $this->result = $result;
    }

    /**
     * Handle getter for specific property names.
     */
    function __get($name) {
        if($name === 'responseMessage'){
            switch ($this->result)
            {
                case \Socketlabs\SendResult::UnknownError:
                    return "An error has occured that was unforeseen";

                case \Socketlabs\SendResult::Timeout:
                    return "A timeout occurred sending the message";

                case \Socketlabs\SendResult::Success:
                    return "Successful send of message";

                case \Socketlabs\SendResult::Warning:
                    return "Warnings were found while sending the message";

                case \Socketlabs\SendResult::InternalError:
                    return "Internal server error";

                case \Socketlabs\SendResult::MessageTooLarge:
                    return "Message size has exceeded the size limit";

                case \Socketlabs\SendResult::TooManyRecipients:
                    return "Message exceeded maximum recipient count in the message";

                case \Socketlabs\SendResult::InvalidData:
                    return "Invalid data was found on the message";

                case \Socketlabs\SendResult::OverQuota:
                    return "The account is over the send quota, rate limit exceeded";

                case \Socketlabs\SendResult::TooManyErrors:
                    return "Too many errors occurred sending the message";

                case \Socketlabs\SendResult::InvalidAuthentication:
                    return "The ServerId/ApiKey combination is invalid";

                case \Socketlabs\SendResult::AccountDisabled:
                    return "The account has been disabled";

                case \Socketlabs\SendResult::TooManyMessages:
                    return "Too many messages were found in the request";

                case \Socketlabs\SendResult::NoValidRecipients:
                    return "No valid recipients were found in the message";

                case \Socketlabs\SendResult::InvalidAddress:
                    return "An invalid recipient were found on the message";

                case \Socketlabs\SendResult::InvalidAttachment:
                    return "An invalid attachment were found on the message";

                case \Socketlabs\SendResult::NoMessages:
                    return "No message body was found in the message";

                case \Socketlabs\SendResult::EmptyMessage:
                    return "No message body was found in the message";

                case \Socketlabs\SendResult::EmptySubject:
                    return "No subject was found in the message";

                case \Socketlabs\SendResult::InvalidFrom:
                    return "An invalid from address was found on the message";

                case \Socketlabs\SendResult::EmptyToAddress:
                    return "No To addresses were found in the message";

                case \Socketlabs\SendResult::NoValidBodyParts:
                    return "No valid message body was found in the message";

                case \Socketlabs\SendResult::InvalidTemplateId:
                    return "An invalid TemplateId was found in the message";

                case \Socketlabs\SendResult::TemplateHasNoContent:
                    return "The specified TemplateId has no content for the message";

                case \Socketlabs\SendResult::MessageBodyConflict:
                    return "A conflict occurred on the message body of the message";

                case \Socketlabs\SendResult::InvalidMergeData:
                    return "Invalid MergeData was found on the message";

                case \Socketlabs\SendResult::AuthenticationValidationFailed:
                    return "SDK Validation Error : Authentication Validation Failed, Missing or invalid ServerId or ApiKey";

                case \Socketlabs\SendResult::RecipientValidationMaxExceeded:
                    return "SDK Validation Error : Message exceeded maximum recipient count in the message";

                case \Socketlabs\SendResult::RecipientValidationNoneInMessage:
                    return "SDK Validation Error : No Recipients were found in the message";

                case \Socketlabs\SendResult::EmailAddressValidationMissingFrom:
                    return "SDK Validation Error : From email address is missing in the message";

                case \Socketlabs\SendResult::RecipientValidationMissingTo:
                    return "SDK Validation Error : To addresses are missing in the message";

                case \Socketlabs\SendResult::EmailAddressValidationInvalidFrom:
                    return "SDK Validation Error : From email address in the message is invalid";

                case \Socketlabs\SendResult::MessageValidationEmptySubject:
                    return "SDK Validation Error : No Subject was found in the message";

                case \Socketlabs\SendResult::MessageValidationEmptyMessage:
                    return "SDK Validation Error : No message body was found in the message";

                case \Socketlabs\SendResult::MessageValidationInvalidCustomHeaders:
                    return "SDK Validation Error : Invalid Custom Headers were found in the message";

                case \Socketlabs\SendResult::RecipientValidationInvalidReplyTo:
                    return "SDK Validation Error : Invalid ReplyTo Address was found in the message";

                case \Socketlabs\SendResult::RecipientValidationInvalidRecipients:
                    return "SDK Validation Error : Invalid recipients were found in the message";

                default:
                    return "";
            }
        }
        user_error("Invalid property: " . __CLASS__ . "->$name");
    }
}