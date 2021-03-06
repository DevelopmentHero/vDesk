<?php
declare(strict_types = 1);

namespace vDesk\Contacts\Contact;

use vDesk\Events\PublicEvent;

/**
 * Represents an Event that occurs when an {@link \vDesk\Contacts\Contact} has been deleted from the contacts.
 *
 * @package Contacts
 * @author Kerry <DevelopmentHero@gmail.com>
 * @version 1.0.0.
 */
class Deleted extends PublicEvent {

    /**
     * The name of the Event.
     */
    public const Name = "vDesk.Contacts.Contact.Deleted";

    /**
     * @inheritdoc
     */
    public function ToDataView() {
        return $this->Arguments->ID;
    }

}
