<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 04.09.2017
 * Time: 15:14
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @Doctrine\ORM\Mapping\Table(name="user")
 * @UniqueEntity(fields="email", message="Taki użytkownik już istnieje w bazie")
 */

class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank(message="Należy wprowadzić adres e-mail")
     * @Assert\Email(message="Wprowadzono nieprawidłowy adres e-mail")
     * @Assert\Length(max="50", maxMessage="Adres może mieć maksymalną długość 50-ciu znaków")
     */
    private $email;
    /**
     * @Assert\NotBlank(message="Należy wprowadzić hasło")
     * @Assert\Length(min="7", minMessage="Hasło powinno zawierać minimum 7 znaków", max="4096")
     */
    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    /**
     * @ORM\Column(type="string",length=50)
     * @Assert\NotBlank(message="Należy wprowadzić nazwę firmy")
     * @Assert\Length(max="50", maxMessage="Nazwa firmy powinna zawierać maksymalnie 50 znaków")
     */
    private $company;
    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="Należy wprowadzić NIP")
     * @Assert\Length(min="5",minMessage="Nip powinien zawierać minimum 5 znaków", max="15", maxMessage="Nip powinien zawierać maksimum 15 znaków")
     */
    private $nip;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Należy wprowadzić REGON")
     * @Assert\Length(min=8,max=9, minMessage="Nieprawidłowy REGON. Sprawdź czy zawiera dokładnie 9 znaków", maxMessage="Nieprawidłowy REGON. Sprawdź czy zawiera dokładnie 9 znaków")
     */
    private $regon;
    /**
     * @ORM\Column(type="boolean")
     *
     */
    private $isActive = false;
    /**
     * @ORM\Column(type="integer")
     */
    private $credit = 0;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="user")
     */
    private $messagesArray;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="sender")
     */
    private $sentMessagesArray;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SystemMessage", mappedBy="user")
     */
    private $systemMessagesArray;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinTable(name="can_text_with",
     *     joinColumns={@ORM\JoinColumn(name="sender_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="recipient_id", referencedColumnName="id")})
     * @var ArrayCollection
     */
    private $canTextWith;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Auction", mappedBy="seller")
     */
    private $auctionCollection;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PurchaseOffer", mappedBy="userCollection")
     */
    private $purchaseOfferCollection;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="user")
     */
    private $product;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AwaitingApprovalProduct", mappedBy="user")
     */
    private $awaitingApprovalProduct;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArchiveProduct", mappedBy="boughtBy")
     */
    private $archiveProduct;

    public function __construct()
    {
        $this->messagesArray = new ArrayCollection();
        $this->systemMessagesArray = new ArrayCollection();
        $this->canTextWith = new ArrayCollection();
        $this->auctionCollection = new ArrayCollection();
        $this->purchaseOfferCollection = new ArrayCollection();
        $this->awaitingApprovalProduct = new ArrayCollection();
    }
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * @param mixed $nip
     */
    public function setNip($nip)
    {
        $this->nip = $nip;
    }

    /**
     * @return mixed
     */
    public function getRegon()
    {
        return $this->regon;
    }

    /**
     * @param mixed $regon
     */
    public function setRegon($regon)
    {
        $this->regon = $regon;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param integer $credit
     */
    public function setCredit(int $credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return mixed
     */
    public function getMessagesArray()
    {
        return $this->messagesArray;
    }

    /**
     * @return mixed
     */
    public function getSentMessagesArray()
    {
        return $this->sentMessagesArray;
    }

    /**
     * @return mixed
     */
    public function getSystemMessagesArray()
    {
        return $this->systemMessagesArray;
    }

    /**
     * @return mixed
     */
    public function getCanTextWith()
    {
        return $this->canTextWith;
    }

    public function addUserToTextWith(User $user){
        if(!$this->canTextWith->contains($user)){
            $this->canTextWith->add($user);
            $user->getCanTextWith()->add($this);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getAwaitingApprovalProduct()
    {
        return $this->awaitingApprovalProduct;
    }



    public function getAuctionCollection()
    {
        return $this->auctionCollection;
    }

    /**
     * @return ArrayCollection
     */
    public function getPurchaseOfferCollection()
    {
        return $this->purchaseOfferCollection;
    }

    /**
     * @param PurchaseOffer $purchaseOffer
     */
    public function addPurchaseOffer(PurchaseOffer $purchaseOffer)
    {
        // TODO: implement method
    }





    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // bcrypt doesnt need Salt, so:
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}