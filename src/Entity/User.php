<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=WorkExperience::class, mappedBy="user")
     */
    private $workExperiences;

    /**
     * @ORM\OneToMany(targetEntity=DigitalProjects::class, mappedBy="user")
     */
    private $digitalProject;

    /**
     * @ORM\OneToMany(targetEntity=ArtProjects::class, mappedBy="user")
     */
    private $artProject;

    /**
     * @ORM\OneToMany(targetEntity=Education::class, mappedBy="user")
     */
    private $education;

    /**
     * @ORM\OneToMany(targetEntity=Languages::class, mappedBy="user")
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity=Sport::class, mappedBy="user")
     */
    private $sports;

    /**
     * @ORM\OneToMany(targetEntity=Skills::class, mappedBy="user")
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=FollowMe::class, mappedBy="user")
     */
    private $followMes;

    /**
     * @ORM\OneToMany(targetEntity=About::class, mappedBy="user")
     */
    private $abouts;

    /**
     * @ORM\OneToMany(targetEntity=Hobbies::class, mappedBy="user")
     */
    private $hobbies;

    public function __construct()
    {
        $this->workExperiences = new ArrayCollection();
        $this->digitalProject = new ArrayCollection();
        $this->artProject = new ArrayCollection();
        $this->education = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->sports = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->followMes = new ArrayCollection();
        $this->abouts = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|WorkExperience[]
     */
    public function getWorkExperiences(): Collection
    {
        return $this->workExperiences;
    }

    public function addWorkExperience(WorkExperience $workExperience): self
    {
        if (!$this->workExperiences->contains($workExperience)) {
            $this->workExperiences[] = $workExperience;
            $workExperience->setUser($this);
        }

        return $this;
    }

    public function removeWorkExperience(WorkExperience $workExperience): self
    {
        if ($this->workExperiences->removeElement($workExperience)) {
            // set the owning side to null (unless already changed)
            if ($workExperience->getUser() === $this) {
                $workExperience->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DigitalProjects[]
     */
    public function getDigitalProject(): Collection
    {
        return $this->digitalProject;
    }

    public function addDigitalProject(DigitalProjects $digitalProject): self
    {
        if (!$this->digitalProject->contains($digitalProject)) {
            $this->digitalProject[] = $digitalProject;
            $digitalProject->setUser($this);
        }

        return $this;
    }

    public function removeDigitalProject(DigitalProjects $digitalProject): self
    {
        if ($this->digitalProject->removeElement($digitalProject)) {
            // set the owning side to null (unless already changed)
            if ($digitalProject->getUser() === $this) {
                $digitalProject->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArtProjects[]
     */
    public function getArtProject(): Collection
    {
        return $this->artProject;
    }

    public function addArtProject(ArtProjects $artProject): self
    {
        if (!$this->artProject->contains($artProject)) {
            $this->artProject[] = $artProject;
            $artProject->setUser($this);
        }

        return $this;
    }

    public function removeArtProject(ArtProjects $artProject): self
    {
        if ($this->artProject->removeElement($artProject)) {
            // set the owning side to null (unless already changed)
            if ($artProject->getUser() === $this) {
                $artProject->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Education[]
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education[] = $education;
            $education->setUser($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getUser() === $this) {
                $education->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Languages[]
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Languages $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
            $language->setUser($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->languages->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getUser() === $this) {
                $language->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports[] = $sport;
            $sport->setUser($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sports->removeElement($sport)) {
            // set the owning side to null (unless already changed)
            if ($sport->getUser() === $this) {
                $sport->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setUser($this);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getUser() === $this) {
                $skill->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FollowMe[]
     */
    public function getFollowMes(): Collection
    {
        return $this->followMes;
    }

    public function addFollowMe(FollowMe $followMe): self
    {
        if (!$this->followMes->contains($followMe)) {
            $this->followMes[] = $followMe;
            $followMe->setUser($this);
        }

        return $this;
    }

    public function removeFollowMe(FollowMe $followMe): self
    {
        if ($this->followMes->removeElement($followMe)) {
            // set the owning side to null (unless already changed)
            if ($followMe->getUser() === $this) {
                $followMe->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|About[]
     */
    public function getAbouts(): Collection
    {
        return $this->abouts;
    }

    public function addAbout(About $about): self
    {
        if (!$this->abouts->contains($about)) {
            $this->abouts[] = $about;
            $about->setUser($this);
        }

        return $this;
    }

    public function removeAbout(About $about): self
    {
        if ($this->abouts->removeElement($about)) {
            // set the owning side to null (unless already changed)
            if ($about->getUser() === $this) {
                $about->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hobbies[]
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobbies $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
            $hobby->setUser($this);
        }

        return $this;
    }

    public function removeHobby(Hobbies $hobby): self
    {
        if ($this->hobbies->removeElement($hobby)) {
            // set the owning side to null (unless already changed)
            if ($hobby->getUser() === $this) {
                $hobby->setUser(null);
            }
        }

        return $this;
    }
}
