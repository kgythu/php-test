<?php
/**
 * portablecontacts.net/draft-spec/
 * 
 * Singular Fields
 * 
 * id: Unique identifier for the Contact. Each Contact returned MUST include a non-empty id value. This identifier MUST be unique across this user’s entire set of Contacts, but MAY not be unique across multiple users’ data. It MUST be a stable ID that does not change when the same contact is returned in subsequent requests. For instance, an e-mail address is not a good id, because the same person may use a different e-mail address in the future. Usually, in internal database ID will be the right choice here, e.g. “12345”.
 * displayName: The name of this Contact, suitable for display to end-users. Each Contact returned MUST include a non-empty displayName value. The name SHOULD be the full name of the Contact being described if known (e.g. Joseph Smarr or Mr. Joseph Robert Smarr, Esq.), but MAY be a username or handle, if that is all that is available (e.g. jsmarr). The value provided SHOULD be the primary textual label by which this Contact is normally displayed by the Service Provider when presenting it to end-users.
 * name: The broken-out components and fully formatted version of the contact’s real name, as described in Section 7.3.
 * nickname (not implemented): The casual way to address this Contact in real life, e.g. “Bob” or “Bobby” instead of “Robert”. This field SHOULD NOT be used to represent a user’s username (e.g. jsmarr or daveman692); the latter should be represented by the preferredUsername field.
 * published (not implemented): The date this Contact was first added to the user’s address book or friends list (i.e. the creation date of this entry). The value MUST be a valid xs:dateTime (e.g. 2008-01-23T04:56:22Z).
 * updated (not implemented): The most recent date the details of this Contact were updated (i.e. the modified date of this entry). The value MUST be a valid xd:dateTime (e.g. 2008-01-23T04:56:22Z). If this Contact has never been modified since its initial creation, the value MUST be the same as the value of published. Note the updatedSince Query Parameter described in Section 6.3 can be used to select only contacts whose updated value is equal to or more recent than a given xs:dateTime. This enables Consumers to repeatedly access a user’s data and only request newly added or updated contacts since the last access time.
 * birthday (not implemented): The birthday of this contact. The value MUST be a valid xs:date (e.g. 1975-02-14. The year value MAY be set to 0000 when the age of the Contact is private or the year is not available.
 * anniversary (not implemented): The wedding anniversary of this contact. The value MUST be a valid xs:date (e.g. 1975-02-14. The year value MAY be set to 0000 when the year is not available.
 * gender (not implemented): The gender of this contact. Service Providers SHOULD return one of the following Canonical Values, if appropriate: male, female, or undisclosed, and MAY return a different value if it is not covered by one of these Canonical Values.
 * note (not implemented): Notes about this contact, with an unspecified meaning or usage (normally contact notes by the user about this contact). This field MAY contain newlines.
 * preferredUsername: The preferred username of this contact on sites that ask for a username (e.g. jsmarr or daveman692). This field may be more useful for describing the owner (i.e. the value when /@me/@self is requested) than the user’s contacts, e.g. Consumers MAY wish to use this value to pre-populate a username for this user when signing up for a new service.
 * utcOffset (not implemented): The offset from UTC of this Contact’s current time zone, as of the time this response was returned. The value MUST conform to the offset portion of xs:dateTime, e.g. -08:00. Note that this value MAY change over time due to daylight saving time, and is thus meant to signify only the current value of the user’s timezone offset.
 * connected (not implemented): Boolean value indicating whether the user and this Contact have established a bi-directionally asserted connection of some kind on the Service Provider’s service. The value MUST be either true or false. The value MUST be true if and only if there is at least one value for the relationship field, described below, and is thus intended as a summary value indicating that some type of bi-directional relationship exists, for Consumers that aren’t interested in the specific nature of that relationship. For traditional address books, in which a user stores information about other contacts without their explicit acknowledgment, or for services in which users choose to “follow” other users without requiring mutual consent, this value will always be false.
 * 
 * Gravatar Specific Singular Fields
 * 
 * hash
 * requestHash
 * profileUrl
 * thumbnailUrl
 * currentLocation
 * aboutMe
 * 
 * Plural Fields
 * 
 * sub fields
 * value: The primary value of this field, e.g. the actual e-mail address, phone number, or URL. When specifying a sortBy field in the Query Parameters for a Plural Field, the default meaning is to sort based on this value sub-field. Each non-empty Plural Field value MUST contain at least the value sub-field, but all other sub-fields are optional.
 * type: The type of field for this instance, usually used to label the preferred function of the given contact information. Unless otherwise specified, this string value specifies Canonical Values of work, home, and other.
 * primary (not implemented): A Boolean value indicating whether this instance of the Plural Field is the primary or preferred value of for this field, e.g. the preferred mailing address or primary e-mail address. Service Providers MUST NOT mark more than one instance of the same Plural Field as primary=”true”, and MAY choose not to mark any fields as primary, if this information is not available. For efficiency, Service Providers SHOULD NOT mark all non-primary fields with primary=”false”, but should instead omit this sub-field for all non-primary instances.
 * title (in urls)
 *
 * emails:
 * E-mail address for this Contact. The value SHOULD be canonicalized by the Service Provider, e.g. joseph@plaxo.com instead of joseph@PLAXO.COM.
 * urls:
 * URL of a web page relating to this Contact. The value SHOULD be canonicalized by the Service Provider, e.g. http://josephsmarr.com/about/ instead of JOSEPHSMARR.COM/about/. In addition to the standard Canonical Values for type, this field also defines the additional Canonical Values blog and profile.
 * phoneNumbers:
 * Phone number for this Contact. No canonical value is assumed here. In addition to the standard Canonical Values for type, this field also defines the additional Canonical Values mobile, fax, and pager.
 * ims:
 * Instant messaging address for this Contact. No official canonicalization rules exist for all instant messaging addresses, but Service Providers SHOULD remove all whitespace and convert the address to lowercase, if this is appropriate for the service this IM address is used for. Instead of the standard Canonical Values for type, this field defines the following Canonical Values to represent currently popular IM services: aim, gtalk, icq, xmpp, msn, skype, qq, and yahoo.
 * photos:
 * URL of a photo of this contact. The value SHOULD be a canonicalized URL, and MUST point to an actual image file (e.g. a GIF, JPEG, or PNG image file) rather than to a web page containing an image. Service Providers MAY return the same image at different sizes, though it is recognized that no standard for describing images of various sizes currently exists. Note that this field SHOULD NOT be used to send down arbitrary photos taken by this user, but specifically profile photos of the contact suitable for display when describing the contact.

 * tags:
 * A user-defined category or label for this contact, e.g. “favorite” or “web20”. These values SHOULD be case-insensitive, and there SHOULD NOT be multiple tags provided for a given contact that differ only in case. Note that this field is a Simple Field, meaning each instance consists only of a string value.
 * relationships:
 * A bi-directionally asserted relationship type that was established between the user and this contact by the Service Provider. The value SHOULD conform to one of the XFN relationship values (e.g. kin, friend, contact, etc.) if appropriate, but MAY be an alternative value if needed. Note this field is a parallel set of category labels to the tags field, but relationships MUST have been bi-directionally confirmed, whereas tags are asserted by the user without acknowledgment by this Contact. Note that this field is a Simple Field, meaning each instance consists only of a string value.
 * addresses:
 * A physical mailing address for this Contact, as described in Section 7.4.
 * organizations:
 * A current or past organizational affiliation of this Contact, as described in Section 7.5.
 * accounts:
 * An online account held by this Contact, as described in Section 7.6.
 * The following additional Plural Fields are defined, based on their specification in OpenSocial: activities, books, cars, children, food, heroes, interests, jobInterests, languages, languagesSpoken, movies, music, pets, politicalViews, quotes, sports, turnOffs, turnOns, and tvShows.
 * 
 * 
 
  ["emails"]=>
  array(1) {
    [0]=>
    array(2) {
      ["primary"]=>
      string(4) "true"
      ["value"]=>
      string(14) "alma@alma.alma"
    }
  }
  ["ims"]=>
  array(5) {
    [0]=>
    array(2) {
      ["type"]=>
      string(3) "aim"
      ["value"]=>
      string(4) "alma"
    }
    [1]=>
    array(2) {
      ["type"]=>
      string(5) "yahoo"
      ["value"]=>
      string(4) "alma"
    }
    [2]=>
    array(2) {
      ["type"]=>
      string(3) "icq"
      ["value"]=>
      string(4) "alma"
    }
    [3]=>
    array(2) {
      ["type"]=>
      string(5) "gtalk"
      ["value"]=>
      string(4) "alma"
    }
    [4]=>
    array(2) {
      ["type"]=>
      string(5) "skype"
      ["value"]=>
      string(4) "alma"
    }
  }
  ["photos"]=>
  array(1) {
    [0]=>
    array(2) {
      ["value"]=>
      string(67) "https://secure.gravatar.com/avatar/79f29094be5e1485e36cfa9e75606b8d"
      ["type"]=>
      string(9) "thumbnail"
    }
  }
  ["accounts"]=>
  array(4) {
    [0]=>
    array(6) {
      ["domain"]=>
      string(12) "facebook.com"
      ["display"]=>
      string(12) "View Profile"
      ["url"]=>
      string(62) "https://www.facebook.com/app_scoped_user_id/10211699511707535/"
      ["username"]=>
      string(17) "10211699511707535"
      ["verified"]=>
      string(4) "true"
      ["shortname"]=>
      string(8) "facebook"
    }
    [1]=>
    array(6) {
      ["domain"]=>
      string(10) "flickr.com"
      ["display"]=>
      string(12) "View Channel"
      ["url"]=>
      string(43) "https://www.flickr.com/people/29680186@N05/"
      ["username"]=>
      string(12) "29680186@N05"
      ["verified"]=>
      string(4) "true"
      ["shortname"]=>
      string(6) "flickr"
    }
    [2]=>
    array(6) {
      ["domain"]=>
      string(19) "profiles.google.com"
      ["display"]=>
      string(19) "profiles.google.com"
      ["url"]=>
      string(48) "http://profiles.google.com/103805915302443365581"
      ["userid"]=>
      string(21) "103805915302443365581"
      ["verified"]=>
      string(4) "true"
      ["shortname"]=>
      string(6) "google"
    }
    [3]=>
    array(6) {
      ["domain"]=>
      string(11) "twitter.com"
      ["display"]=>
      string(7) "@kgythu"
      ["url"]=>
      string(25) "http://twitter.com/kgythu"
      ["username"]=>
      string(6) "kgythu"
      ["verified"]=>
      string(4) "true"
      ["shortname"]=>
      string(7) "twitter"
    }
  }
 * 
 * name Element
 * 
 * formatted:
 * The full name, including all middle names, titles, and suffixes as appropriate, formatted for display (e.g. Mr. Joseph Robert Smarr, Esq.). This is the Primary Sub-Field for this field, for the purposes of sorting and filtering.
 * familyName:
 * The family name of this Contact, or “Last Name” in most Western languages (e.g. Smarr given the full name Mr. Joseph Robert Smarr, Esq.).
 * givenName:
 * The given name of this Contact, or “First Name” in most Western languages (e.g. Joseph given the full name Mr. Joseph Robert Smarr, Esq.).
 * middleName (not implemented):
 * The middle name(s) of this Contact (e.g. Robert given the full name Mr. Joseph Robert Smarr, Esq.).
 * honorificPrefix (not implemented):
 * The honorific prefix(es) of this Contact, or “Title” in most Western languages (e.g. Mr. given the full name Mr. Joseph Robert Smarr, Esq.).
 * honorificSuffix (not implemented):
 * The honorifix suffix(es) of this Contact, or “Suffix” in most Western languages (e.g. Esq. given the full name Mr. Joseph Robert Smarr, Esq.).
 * 
 * address Element (not implemented)
 * 
 * formatted:
 * The full mailing address, formatted for display or use with a mailing label. This field MAY contain newlines. This is the Primary Sub-Field for this field, for the purposes of sorting and filtering.
 * streetAddress:
 * The full street address component, which may include house number, street name, PO BOX, and multi-line extended street address information. This field MAY contain newlines.
 * locality:
 * The city or locality component.
 * region:
 * The state or region component.
 * postalCode:
 * The zipcode or postal code component.
 * country:
 * The country name component.
 * 
 * organization Element (not implemented)
 * 
 * name:
 * The name of the organization (e.g. company, school, or other organization). This field MUST have a non-empty value for each organization returned. This is the Primary Sub-Field for this field, for the purposes of sorting and filtering.
 * department:
 * The department within this organization.
 * title:
 * The job title or role within this organization.
 * type:
 * The type of organization, with Canonical Values job and school.
 * startDate:
 * The date this Contact joined this organization. This value SHOULD be a valid xs:date if possible, but MAY be an unformatted string, since it is recognized that this field is often presented as free-text.
 * endDate:
 * The date this Contact left this organization or the role specified by title within this organization. This value SHOULD be a valid xs:date if possible, but MAY be an unformatted string, since it is recognized that this field is often presented as free-text.
 * location:
 * The physical location of this organization. This may be a complete address, or an abbreviated location like “San Francisco”.
 * description:
 * A textual description of the role this Contact played in this organization. This field MAY contain newlines.
 * 
 * account Element (not implemented)
 * 
 * domain:
 * The top-most authoritative domain for this account, e.g. “twitter.com”. This is the Primary Sub-Field for this field, for the purposes of sorting and filtering.
 * username:
 * An alphanumeric user name, usually chosen by the user, e.g. “jsmarr”.
 * userid:
 * A user ID number, usually chosen automatically, and usually numeric but sometimes alphanumeric, e.g. “12345” or “1Z425A”.
 */
function formatted_gravatar_profile($profile, $print = true, $tab = 1) {
	$return = '';
	// tab
	$ind = '';
	for($i = 0; $i < $tab; $i++) {
		$ind .= "\t";
	};
	// table head
	$return .= $ind . '<table style="width: auto;" class="table table-striped table-hover table-bordered">' . "\n";
	$return .= $ind . "\t" . '<caption>Gravatar profil</caption>' . "\n";
	// name
	$return .= $ind . "\t" . '<tr class="info">' . "\n";
	$return .= $ind . "\t\t" . '<th colspan="2">Név adatok</th>' . "\n";
	$return .= $ind . "\t" . '</tr>' . "\n";
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Keresztnév</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["name"]["givenName"] . '</td>' . "\n";
	$return .= $ind . "\t" . '</tr>' . "\n";
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Vezetéknév</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["name"]["familyName"] . '</td>' . "\n";
	$return .= $ind . "\t" . '</tr>' . "\n";
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Formázott név</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["name"]["formatted"] . '</td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // fields
    // - id
    // - displayName
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Megjelenő név</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["displayName"] . '</td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // - preferredUsername
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Preferált  felhasználói név</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["preferredUsername"] . '</td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // Other data
	$return .= $ind . "\t" . '<tr class="info">' . "\n";
	$return .= $ind . "\t\t" . '<th colspan="2">Egyéb adatok</th>' . "\n";
	$return .= $ind . "\t" . '</tr>' . "\n";
    // - hash (gravatar specific)
    // - requestHash (gravatar specific)
    // - profileUrl (gravatar specific)
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Gravatar profil</th>' . "\n";
	$return .= $ind . "\t\t" . '<td><a href="' . $profile["profileUrl"] . '">' . $profile["profileUrl"] . '</a></td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // - thumbnailUrl (gravatar specific)
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Gravatar profilkép</th>' . "\n";
	$return .= $ind . "\t\t" . '<td><a href="' . $profile["thumbnailUrl"] . '"><img alt="Grevatar profilkép" src="' . $profile["thumbnailUrl"] . '?s=80&d=mp&r=g" /></a></td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // - currentLocation (gravatar specific)
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Tartózkodási hely</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . $profile["currentLocation"] . '</td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // - aboutMe (gravatar specific)
	$return .= $ind . "\t" . '<tr>' . "\n";
	$return .= $ind . "\t\t" . '<th>Bemutatkozás</th>' . "\n";
	$return .= $ind . "\t\t" . '<td>' . preg_replace('/\n/', "<br />\n", $profile["aboutMe"]) . '</td>' . "\n";
    $return .= $ind . "\t" . '</tr>' . "\n";
    // - urls
    if(is_array($profile["urls"]) && count($profile["urls"])) {
        $return .= $ind . "\t" . '<tr class="info">' . "\n";
        $return .= $ind . "\t\t" . '<th colspan="2">Weboldal';
        if(count($profile["urls"]) > 1) $return .= 'ak';
        $return .= '</th>' . "\n";
        $return .= $ind . "\t" . '</tr>' . "\n";
        foreach($profile["urls"] as $url) {
            $return .= $ind . "\t" . '<tr>' . "\n";
            $return .= $ind . "\t\t" . '<td colspan="2"><a href="' . $url["value"]
                . '"><i class="fa fa-external-link-square"></i> '
                . $url["title"] . '</a></td>' . "\n";
            $return .= $ind . "\t" . '</tr>' . "\n";
        };
    };
    // - phoneNumbers
    if(is_array($profile["phoneNumbers"]) && count($profile["phoneNumbers"])) {
        $return .= $ind . "\t" . '<tr class="info">' . "\n";
        $return .= $ind . "\t\t" . '<th colspan="2">Telefonszám';
        if(count($profile["phoneNumbers"]) > 1) $return .= 'ok';
        $return .= '</th>' . "\n";
        $return .= $ind . "\t" . '</tr>' . "\n";
        foreach($profile["phoneNumbers"] as $phone) {
            $return .= $ind . "\t" . '<tr>' . "\n";
            $return .= $ind . "\t\t" . '<th>' . phone_types($phone["type"]) . '</th>' . "\n";
            $return .= $ind . "\t\t" . '<td><a href="tel:' . $phone["value"]
                . '"><i class="fa fa-phone-square"></i> '
                . $phone["value"] . '</a></td>' . "\n";
            $return .= $ind . "\t" . '</tr>' . "\n";
        };
    };

	// table foot
	$return .= $ind . '</table>' . "\n";
	if($print) echo $return;
	return $return;
}
?>