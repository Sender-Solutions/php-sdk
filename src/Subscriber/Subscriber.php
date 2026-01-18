<?php

namespace SenderSolutions\Subscriber;

use DateTime;
use InvalidArgumentException;
use LogicException;

class Subscriber
{
    private int $Id = 0;
    private Base $Base;

    /**
     * @var array string[]
     */
    private array $Tags = [];

    private bool $IsActive = false;
    private string $Email;
    private ?string $FirstName = null;
    private ?string $LastName = null;
    private string $Gender = '';
    private ?string $Phone = null;


    private ?string $ClientUserId = null;
    private ?string $CustomField1 = null;
    private ?string $CustomField2 = null;
    private ?string $CustomField3 = null;
    private ?string $AddressCountry = null;
    private ?string $AddressCity = null;
    private ?string $AddressState = null;
    private ?string $AddressZip = null;
    private ?string $AddressLine1 = null;
    private ?string $AddressLine2 = null;
    private ?string $AddressLine3 = null;
    private ?string $Birthday = null;

    public function __construct(string $Email, string $FirstName = '', string $LastName = '')
    {
        $this->Email = $Email;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
    }

    public function toArray(): array
    {
        if (!isset($this->Base)) {
            throw new LogicException('Subscriber: Base is not set');
        }
        if (!isset($this->Email)) {
            throw new LogicException('Subscriber: Email is not set');
        }

        return [
            'Id' => $this->Id,
            'Base' => $this->Base->toArray(),
            'IsActive' => $this->IsActive,
            'Email' => $this->Email,
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'Gender' => $this->Gender,
            'Phone' => $this->Phone,
            'Tags' => $this->Tags,
            'ClientUserId' => $this->ClientUserId,
            'CustomField1' => $this->CustomField1,
            'CustomField2' => $this->CustomField2,
            'CustomField3' => $this->CustomField3,
            'Address' => [
                'Country' => $this->AddressCountry,
                'City' => $this->AddressCity,
                'State' => $this->AddressState,
                'Zip' => $this->AddressZip,
                'Line1' => $this->AddressLine1,
                'Line2' => $this->AddressLine2,
                'Line3' => $this->AddressLine3,
            ],
            'Birthday' => $this->Birthday,
        ];
    }

    public static function fromJsonResponse(array $subscriberData): Subscriber
    {
        $subscriber = new Subscriber($subscriberData['Email'], $subscriberData['FirstName'], $subscriberData['LastName']);

        $subscriber
            ->setId($subscriberData['Id'])
            ->setGender($subscriberData['Gender'])
            ->setIsActive($subscriberData['IsActive'])
            ->setPhone($subscriberData['Phone'])
            ->setClientUserId($subscriberData['ClientUserId'])
            ->setCustomField1($subscriberData['CustomField1'])
            ->setCustomField2($subscriberData['CustomField2'])
            ->setCustomField3($subscriberData['CustomField3'])
            ->setAddressCountry($subscriberData['Address']['Country'])
            ->setAddressCity($subscriberData['Address']['City'])
            ->setAddressState($subscriberData['Address']['State'])
            ->setAddressZip($subscriberData['Address']['Zip'])
            ->setAddressLine1($subscriberData['Address']['Line1'])
            ->setAddressLine2($subscriberData['Address']['Line2'])
            ->setAddressLine3($subscriberData['Address']['Line3'])
            ->setBirthday($subscriberData['Birthday'])
            ->setBase(new Base($subscriberData['Base']['Id'], $subscriberData['Base']['Name']))
            ->setTags($subscriberData['Tags'])
        ;

        return $subscriber;
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function setId(int $Id): static
    {
        $this->Id = $Id;
        return $this;
    }

    public function getBase(): Base
    {
        return $this->Base;
    }

    public function setBase(Base $Base): static
    {
        $this->Base = $Base;
        return $this;
    }

    public function getTags(): array
    {
        return $this->Tags;
    }

    public function setTags(array $Tags): static
    {
        $this->Tags = array_unique($this->Tags);
        return $this;
    }

    public function addTag(string $tag): static
    {
        $this->Tags[] = $tag;
        $this->Tags = array_unique($this->Tags);
        return $this;
    }

    public function removeTag(string $tag): static
    {
        $new = [];
        foreach ($this->Tags as $value) {
            if ($value !== $tag) {
                $new[] = $value;
            }
        }
        $this->Tags = array_unique($new);
        return $this;
    }

    public function isIsActive(): bool
    {
        return $this->IsActive;
    }

    public function setIsActive(bool $IsActive): static
    {
        $this->IsActive = $IsActive;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): static
    {
        $this->FirstName = $FirstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): static
    {
        $this->LastName = $LastName;
        return $this;
    }

    public function getGender(): string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): static
    {
        $this->Gender = $Gender;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): static
    {
        $this->Phone = $Phone;
        return $this;
    }

    public function getClientUserId(): ?string
    {
        return $this->ClientUserId;
    }

    public function setClientUserId(?string $ClientUserId): static
    {
        $this->ClientUserId = $ClientUserId;
        return $this;
    }

    public function getCustomField1(): ?string
    {
        return $this->CustomField1;
    }

    public function setCustomField1(?string $CustomField1): static
    {
        $this->CustomField1 = $CustomField1;
        return $this;
    }

    public function getCustomField2(): ?string
    {
        return $this->CustomField2;
    }

    public function setCustomField2(?string $CustomField2): static
    {
        $this->CustomField2 = $CustomField2;
        return $this;
    }

    public function getCustomField3(): ?string
    {
        return $this->CustomField3;
    }

    public function setCustomField3(?string $CustomField3): static
    {
        $this->CustomField3 = $CustomField3;
        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->AddressCountry;
    }

    public function setAddressCountry(?string $AddressCountry): static
    {
        $this->AddressCountry = $AddressCountry;
        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->AddressCity;
    }

    public function setAddressCity(?string $AddressCity): static
    {
        $this->AddressCity = $AddressCity;
        return $this;
    }

    public function getAddressState(): ?string
    {
        return $this->AddressState;
    }

    public function setAddressState(?string $AddressState): static
    {
        $this->AddressState = $AddressState;
        return $this;
    }

    public function getAddressZip(): ?string
    {
        return $this->AddressZip;
    }

    public function setAddressZip(?string $AddressZip): static
    {
        $this->AddressZip = $AddressZip;
        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    public function setAddressLine1(?string $AddressLine1): static
    {
        $this->AddressLine1 = $AddressLine1;
        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    public function setAddressLine2(?string $AddressLine2): static
    {
        $this->AddressLine2 = $AddressLine2;
        return $this;
    }

    public function getAddressLine3(): ?string
    {
        return $this->AddressLine3;
    }

    public function setAddressLine3(?string $AddressLine3): static
    {
        $this->AddressLine3 = $AddressLine3;
        return $this;
    }

    public function getBirthday(): ?string
    {
        return $this->Birthday;
    }

    /**
     * @param string|null $Birthday String in YYYY-MM-DD format
     * @return $this
     */
    public function setBirthday(?string $Birthday): static
    {
        if ($Birthday !== null) {
            $dt = DateTime::createFromFormat('Y-m-d', $Birthday);

            if (($dt === false) || $dt->format('Y-m-d') != $Birthday) {
                throw new InvalidArgumentException('Birthday is not a valid date');
            }
        }

        $this->Birthday = $Birthday;
        return $this;
    }
}
