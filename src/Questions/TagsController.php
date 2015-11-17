<?php

namespace Anax\Questions;

/**
 * Manage tags
 *
 */
class TagsController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->tags = new \Anax\Questions\Tags();
        $this->tags->setDI($this->di);

        $this->question2tags = new \Anax\Questions\Question2Tags();
        $this->question2tags->setDI($this->di);

        $this->viewTag = new \Anax\Questions\VTags();
        $this->viewTag->setDI($this->di);
    }

    /**
     * View all tags.
     *
     * @return void
     */
    public function viewAllAction()
    {
        //Get all tags
        $all = $this->viewTag->findAll();

        //Add to view
        $this->views->add('questions/tags', [
            'tags' => $all,
        ]);

        //Show most popular tags in sidebar
        $this->viewMostPopularAction();
    }

    /**
    * View most popular tags
    *
    * @param string $all if set, show all tags ordered by popularity. If null, show top 5
    *
    * @return void
    */
    public function viewMostPopularAction($all = null) {

        //If $all is not null
        if(!is_null($all)) {

            //Get all tags and order by popularity
            $showPopular = $this->viewTag->query()
                ->orderBy('nrQuestions DESC')
                ->execute();

                $title = "Populära taggar";

        } else {

            //Get five most popular tags
            $showPopular = $this->viewTag->query()
                ->orderBy('nrQuestions DESC')
                ->limit('5')
                ->execute();

                $title = "Topp 5 taggar";
        }

        //Add to view in sidebar
        $this->views->add('questions/firstpageTags', [
            'title' => $title,
            'tags' => $showPopular,
            //'tagQuestions' => $tagsAndQuestions,
        ], 'sidebar');
    }

    /**
     * View all questions for a specific tag
     *
     * @param int $id with question id
     *
     * @return void
     */
    public function viewAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        //Get all rows with question ids for the requested tag
        $tag = $this->question2tags->query()
            ->where('idTag = ?')
            ->execute(array($id));

        //Did the query return any rows?
        if (!empty($tag)) {

            //Get description for tag
            $getDescription = $this->tags->find($id);

            $this->theme->setTitle("Frågor om " . $getDescription->tag);

            //Add description for tag to view
            $this->views->add('default/page', [
                'content' => "<div class='tag-description'><h4>" . $getDescription->tag . "</h4><p>" . $getDescription->description . "</p></div>",
            ]);

            $questions = new \Anax\Questions\Vquestions();
            $questions->setDI($this->di);

            $answers = new \Anax\Questions\Answers();
            $answers->setDI($this->di);

            $ids = [];
            $qMarks;

            //Iterate over the question ids and push into array
            foreach ($tag as $id => $thistag) {
                array_push($ids, $thistag->idQuestion);

                //create string with tokens to use with query
                if ($id == 0) {
                    $qMarks = "?";
                } else {
                    $qMarks .= ", ?";
                }
            }

            //Get all answers for the questions with matching id
            $allAnswers = $answers->query()
                ->where('questionId IN (' . $qMarks . ')')
                ->execute($ids);

            //Get all questions with matching id
            $questionIds = $questions->query()
                ->where('id IN (' . $qMarks . ')')
                ->execute($ids);

            //Did the question query return rows?
            if (!empty($questionIds)) {

                //Add view with question details
                $this->views->add('questions/question', [
                    //'tags' => $questionIds,
                    'questions' => $questionIds,
                    'answers'   => $allAnswers,
                    'back'      => $id
                ]);
            }

        //If no rows were returned from database, show info message
        } else {
            $this->theme->setTitle("Fanns inga frågor");
            $this->views->add('default/page', [
                'title' => "Här var det tomt",
                'content' => "Inga frågor finns i denna kategori ännu",
                'links' => [
                    ['href' => $this->url->create('tags'), 'text' => 'Tillbaka']
                ],
            ]);
        }

    }

}
