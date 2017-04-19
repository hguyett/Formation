<?php
namespace FormBuilder;
use OCFram\FormBuilder;
use OCFram\StringField;
use OCFram\TextField;
use OCFram\NotNullValidator;
use OCFram\MaxLengthValidator;

/**
 *
 */
class NewsFormBuilder extends FormBuilder
{

    public function build()
    {
        $authorField = new StringField;
        $authorField->setLabel('Auteur')->setName('author')->setMaxLength(30);
        $authorField->addValidator(new NotNullValidator('L\'auteur doit être indiqué'));
        $authorField->addValidator(new MaxLengthValidator('Le nom de l\'auteur ne peut pas excéder 30 caractères.', 30));

        $this->form->add($authorField);

        $titleField = new StringField;
        $titleField->setLabel('Titre')->setName('title')->setMaxLength(100);
        $titleField->addValidator(new NotNullValidator('Un titre doit être spécifié'));
        $titleField->addValidator((new MaxLengthValidator('Le titre ne peut pas excéder 100 caractères.', 100)));

        $this->form->add($titleField);

        $contentField = new TextField;
        $contentField->setLabel('Contenu')->setName('content')->setRows(8)->setCols(60);
        $contentField->addValidator(new NotNullValidator('Le contenu ne peut être vide.'));

        $this->form->add($contentField);
    }
}
