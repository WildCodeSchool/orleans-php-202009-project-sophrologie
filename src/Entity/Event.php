<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;
use DateTimeInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"title"},
 *     message="L'actualité existe déjà'"
 * )
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private ?string $url = null;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type("DateTime")
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Assert\Url()
     */
    private ?string $eventlink;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $article;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */

    private Category $category;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type("DateTime")
     */
    private ?\DateTimeInterface $eventdate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Assert\Url()
     */
    private ?string $video;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $archive;

    /**
     * @Vich\UploadableField(mapping="url_file", fileNameProperty="url")
     * @var File
     */

    private ?File $urlFile = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTimeInterface
     */

    private ?\DateTimeInterface $uploadedAt ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEventlink(): ?string
    {
        return $this->eventlink;
    }

    public function setEventlink(?string $eventlink): self
    {
        $this->eventlink = $eventlink;

        return $this;
    }


    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getEventdate(): ?\DateTimeInterface
    {
        return $this->eventdate;
    }

    public function setEventdate(?\DateTimeInterface $eventdate): self
    {
        $this->eventdate = $eventdate;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function setUrlFile(File $image = null): Event
    {
        $this->urlFile = $image;
        if ($image) {
            $this->uploadedAt = new DateTime('now');
        }
        return $this;
    }


    public function getUrlFile(): ?File
    {
        return $this->urlFile;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(?\DateTimeInterface $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }
}
