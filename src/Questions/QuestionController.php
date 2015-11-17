<?php

namespace Anax\Questions;

/**
 * Questions flow
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->questions = new \Anax\Questions\Question();
        $this->questions->setDI($this->di);

        $this->answers = new \Anax\Questions\Answers();
        $this->answers->setDI($this->di);

        $this->tags = new \Anax\Questions\Tags();
        $this->tags->setDI($this->di);

        $this->view = new \Anax\Questions\Vquestions();
        $this->view->setDI($this->di);

        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);

        $this->comments = new \Anax\Questions\Comments();
        $this->comments->setDI($this->di);

        $this->tagToQ = new \Anax\Questions\Question2Tags();
        $this->tagToQ->setDI($this->di);

        $this->votes = new \Anax\Questions\Uservoting();
        $this->votes->setDI($this->di);
    }

    /*
---------------------------- QUESTIONS ---------------------------
    */

    /**
     * View all questions.
     *
     * @return void
     */
    public function viewAllAction()
    {
        //Get all questions from database, sort by most recently created
        $allQuestions = $this->view->query()
            ->orderBy('timestamp DESC')
            ->execute();

        //Get all answers from database
        $allAnswers = $this->answers->findAll();

        //Add questions and answers to view
        $this->views->add('questions/question', [
            'questions' => $allQuestions,
            'answers'   => $allAnswers,
        ]);

        //Show most popular tags in sidebar
        $this->dispatcher->forward([
			'controller' => 'tags',
			'action'     => 'viewMostPopular',
            'params' => ['all'],
		]);
    }


    /**
    * View 10 latest questions
    *
    * @return void
    */
    public function viewLatestAction() {
        //Get the 10 latest questions
        $allQuestions = $this->view->query()
            ->orderBy('timestamp DESC')
            ->limit('10')
            ->execute();

        //Get all answers
        $allAnswers = $this->answers->findAll();

        //Add questions and answers to view
        $this->views->add('questions/firstpageQuestions', [
            'questions' => $allQuestions,
            'answers'   => $allAnswers,
        ]);
    }

    /**
    * Add a view to show the question
    *
    * @param array $question with details about questions (from database)
    *
    * @return void
    */
    private function viewQuestionsAction($question) {

        //Is user logged in?
        $loggedInUser = $this->session->has('user') ? $this->session->get('user') : null;

        //Get user information about the question author
        $user = $this->users->query()
            ->where('acronym = ?')
            ->execute(array($question->author));

        //If user is logged in get user votes
        if(!is_null($loggedInUser)) {
            //Get user information about the logged in user
            $loggedInUserInfo = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($loggedInUser));

            //Get all votes the logged in user has made
            $votes = $this->votes->query()
                ->where('idUser = ?')
                ->execute(array($loggedInUserInfo[0]->id));
        } else {
            $votes = null;
        }

        //Get all tags related to the current question
        $relevantTags = $this->tagToQ->query()
            ->where('idQuestion = ?')
            ->execute(array($question->id));

        if (!empty($relevantTags)) {

            $allTags = [];
            $qmarks;

            //loop through all tags and push in id for the tag to prepare for query
            foreach ($relevantTags AS $nr => $row) {
                array_push($allTags, $row->idTag);

                //Add an equal amount of question marks to be used in query
                if ($nr == 0) {
                    $qmarks = "?";
                } else {
                    $qmarks .= ", ?";
                }
            }

            //Do query to get all tags and tag names related to the question
            $tagsToShow = $this->tags->query()
                ->where('id IN (' . $qmarks .')')
                ->execute($allTags);

        } else {
            $tagsToShow = null;
        }

        //Get all comments related to the question
        $comments = $this->comments->query()
            ->where('questionId = ?')
            ->andWhere('answerId IS NULL')
            ->execute(array($question->id));

        //Filter the question content to apply markdown
        $content = $this->textFilter->doFilter($question->content, "markdown");

        $this->theme->setTitle($question->title);

        //Add view with question details
        $this->views->add('questions/read', [
            'id'    => $question->id,
            'title' => $question->title,
            'content' => $content,
            'timestamp'  => $question->timestamp,
            'author' => $user[0]->acronym,
            'gravatar' => $user[0]->gravatar,
            'userid'    => $user[0]->id,
            'tags'     => $tagsToShow,
            'comments' => $comments,
            'score' => $question->score,
            'loggedInUser' => $loggedInUser,
            'votes' => $votes
        ]);
    }

    /**
     * View a certain question based on id.
     *
     * @param int $id with question id
     * @param string $sortby how to sort answers to question (latest, oldest, rank)
     *
     * @return void
     */
    public function viewAction($id = null, $sortBy = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        //Get the data row with correct id from database
        $question = $this->questions->find($id);

        if (!empty($question)) {

            /*
            ---------Add views-----------
            */

            //Question and comments to question
            $this->viewQuestionsAction($question);

            //Answers to question and comments to answers
            $this->viewAnswersAction($question->id, $question->author, $sortBy);

            //Form to answer the question
            $this->answerAction($question->id);

        } else {

            //if id not found in database
            $this->theme->setTitle("Frågan finns ej");
            $this->views->add('default/page', [
                'title' => "Hoppsan, något gick fel",
                'content' => "Finns ingen fråga med det id:et."
            ]);
        }

    }

    /**
     * View all questions created by a specific user.
     *
     * @param int $id with user id
     *
     * @return void
     */
    public function viewUserQuestionsAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $this->theme->setTitle("Användarens frågor");

        //Get user from database, based on id
        $userId = $this->users->find($id);

        //Is user found in database?
        if($userId) {
            //If user is found

            //Get all answers made by user
            $userAnswers = $this->answers->query()
                ->where('userId = ?')
                ->execute(array($id));

            //Get all questions created by user
            $all = $this->view->query()
                ->where('userId = ?')
                ->execute(array($id));

            //Have user made any questions yet?
            if($all) {
                //If questions were found, add them to view
                $this->views->add('questions/firstpageQuestions', [
                    'title'     => "Frågor av " . $userId->acronym,
                    'questions' => $all,
                    'answers'   => $userAnswers,
                    //'author'    => $userId->acronym
                ]);
            } else {
                //If no questions were found, display info message
                $this->views->add('default/page', [
                    'title' => 'Här var det tomt',
                    'content'   => 'Användaren har inga frågor ännu'
                ]);
            }

        } else {
            //Couldn't find the user with given id in database, display info message
            $this->views->add('default/page', [
                'title' => 'Ingen användare hittad',
                'content'   => 'Finns ingen användare med det id:et'
            ]);
        }


    }

    /**
    * Show the five latest questions by user to display on profile page
    *
    * @param integer $id with user id
    *
    * @return void
    */
    public function latestUserQuestionsAction($id = null) {

        if(!isset($id)) {
            die("Missing id");
        }

        //Get the 5 latest questions by user, sort by newest
        $questions = $this->view->query()
            ->where('userId = ?')
            ->orderBy('timestamp DESC')
            ->limit('5')
            ->execute(array($id));

        //Add to view
        $this->views->add('questions/profileQuestion', [
            'questions' => $questions,
        ]);
    }

    /**
     * Add a new question.
     *
     * @return void
     */
    public function addAction()
    {
        //Check if user is logged in
        $acronym = $this->session->has('user') ? $this->session->get('user') : null;

        $this->theme->setTitle('Ställ en fråga');

        //Is user logged in?
        if (!$acronym) {

            //If not logged in, show info page
            $this->di->views->add('default/page', [
                'title' => "Skapa ny fråga",
                'content' => "Du måste vara inloggad för att skriva en fråga"
            ]);
        } else {
            //If user is logged in

            //Get details about logged in user from database
            $user = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($acronym));

            //Get all tags from database
            $allCategories = $this->tags->findAll();

            $categories = array();

            //Loop through all tags to push tag names into array. To be used with
            // the checkboxes in form
            foreach ($allCategories AS $id => $category) {
                Array_push($categories, $category->tag);
            }

            //Add form to add a new question
            $form = new \Anax\HTMLForm\CFormAddQuestion($acronym, $categories, $user[0]->id);
            $form->setDI($this->di);
            $form->check();

            //Add to view
            $this->di->views->add('default/page', [
                'title' => "Skapa ny fråga",
                'content' => $form->getHTML()
            ]);
        }

    }

    /*
---------------------------- ANSWERS ------------------------------------------
    */

    /**
     * View all answers for a specific question
     *
     * @param int $id with question id
     * @param string $author who wrote the question
     * @param string $sortby how to sort answers (latest, oldest, rank)
     *
     * @return void
     */
    private function viewAnswersAction($id, $author, $sortBy)
    {
        //Is user logged in?
        if ($this->session->has('user')) {

            //Is the logged in user the same user who wrote the question?
            //If so, the user has the right to mark an answer as accepted
            $accept = $this->session->get('user') == $author ? true : false;

            //Get information about the logged in user
            $user = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($this->session->get('user')));

            //Get all votes the user has made
            $usersVotes = $this->votes->query()
                ->where('idUser = ?')
                ->execute(array($user[0]->id));

        } else {
            $usersVotes = null;
            $accept = false;
        }


        //Get data from database and sort it in desired order
        if ($sortBy == 'latest') { //Sort by most recently added answers
            $answers = $this->answers->query()
                ->where('questionId = ?')
                ->orderBy('timestamp DESC')
                ->execute(array($id));
        } elseif ($sortBy == 'rank') { // Sort by ranking
            $answers = $this->answers->query()
                ->where('questionId = ?')
                ->orderBy('score DESC')
                ->execute(array($id));
        } else {
            $answers = $this->answers->query() //default sorting (oldest first)
                ->where('questionId = ?')
                ->orderBy('timestamp ASC')
                ->execute(array($id));
            $sortBy = 'oldest';
        }

        //Get all comments to answers
        $comments = $this->comments->query()
            ->where('answerId IS NOT NULL')
            ->execute();

        //Add to view
        $this->views->add('questions/answers', [
            'answers' => $answers,
            'comments' => $comments,
            'questionId' => $id,
            'canAccept'   => $accept,
            'selected'  => $sortBy,
            'loggedInUser' => $this->session->get('user'),
            'usersVotes'    => $usersVotes
        ]);

    }

    /**
     * Answer a question.
     *
     * @param integer $id id of question being answered
     *
     * @return void
     */
    private function answerAction($id = null)
    {
        //Set acronym to user acronym if user is logged in
        $acronym = $this->session->has('user') ? $this->session->get('user') : null;

        //If user is not logged in, display info message about logging in
        if (!$acronym) {
                $this->di->views->add('default/page', [
                    'content' => "<p>Du måste vara inloggad för att svara på en fråga. <a
 href='" . $this->url->create('login') . "' title='Logga in'>Logga in</a>",
                ]);
        } else {
            //If user is logged in, show form to respond to a question


            //Get information about logged in user
            $getUser = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($acronym));

            //User's gravatar and id
            $gravatar = $getUser[0]->gravatar;
            $userId = $getUser[0]->id;

            //Form to respond to question
            $form = new \Anax\HTMLForm\CFormAnswerQuestion($acronym, $id, $gravatar, $userId);
            $form->setDI($this->di);
            $form->check();

            //Add form to view
            $this->di->views->add('default/page', [
            'title' => "",
            'content' => $form->getHTML()
            ]);
        }
    }

    /**
    * Show the five latest answers by user to display on profile page
    *
    * @param integer $id with user id
    *
    * @return void
    */
    public function latestUserAnswersAction($id = null) {

        if(!isset($id)) {
            die("Missing id");
        }

        //Get the 5 most recently posted answers by user
        $answers = $this->answers->query()
            ->where('userId = ?')
            ->orderBy('timestamp DESC')
            ->limit('5')
            ->execute(array($id));


        //$acronym = $this->users->find($id);

        //Get all questions from database
        $questions = $this->view->findAll();

        //Add to view
        $this->views->add('questions/profileAnswer', [
            'answers' => $answers,
            'questions' => $questions,
        ]);
    }

    /**
     * View all answers by specific user.
     *
     * @param integer $id with user id
     *
     * @return void
     */
    public function viewUserAnswersAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $this->theme->setTitle("Användarens svar");

        //Get user details from database
        $userId = $this->users->find($id);

        $acronym = $userId->acronym;

        //Get all answers made by the given user
        $answers = $this->answers->query()
            ->where('author = ?')
            ->execute(array($acronym));

        //Have the user made any answers yet?
        if (!empty($answers)) {

            //Find all questions from database
            $questions = $this->view->findAll();

            //Add to view
            $this->views->add('questions/userAnswer', [
                'answers' => $answers,
                'questions' => $questions,
                'author'    => $acronym
            ]);

        } else {
            //If user has not made any anwers yet, show info message
            $this->views->add('default/page', [
                'title' => "Här var det tomt",
                'content' => "Inga svar ännu.",
            ]);
        }
    }


    /**
    * Mark answer as accepted (can only be done if logged in user is the same as question author)
    *
    * @param int $idQuestion id to question
    * @param int $idAnswer id to answer
    *
    * @return void
    */
    public function acceptAction($idQuestion = null, $idAnswer = null) {

        if(!isset($idQuestion) || !isset($idAnswer)) {
            die("missing id");
        }

        //Is user logged in?
        $acronym = $this->session->has('user') ? $this->session->get('user') : null;

        if(!$acronym) {
            //Show info message if user is not logged in
            $this->di->views->add('default/page', [
                'title' => "Inloggning krävs",
                'content' => "Du behöver vara inloggad för att göra detta"
            ]);
        } else {
            //If user is logged in

            //Check if the chosen answer and question can be found in the database
            $checkIfInAnswerDatabase = $this->answers->find($idAnswer);
            $checkIfInQuestionDatabase = $this->questions->find($idQuestion);

            //If question is found in database but logged in user is not the same as question author
            if (!empty($checkIfInQuestionDatabase) && $checkIfInQuestionDatabase->author != $acronym) {
                $this->di->views->add('default/page', [
                    'title' => "Inloggning krävs",
                    'content' => "Du måste vara inloggad för att göra detta."
                ]);

               //If question or answer can't be found in database
            } else if(empty($checkIfInAnswerDatabase) || empty($checkIfInQuestionDatabase)) {
                $this->di->views->add('default/page', [
                    'title' => "Hoppsan",
                    'content' => "Det svar du vill acceptera finns inte."
                ]);

             //If question and answer is found and user is same as question author
            } else {

                //Get answers related to the question
                $answersToQuestions = $this->answers->query()
                    ->where('questionId = ?')
                    ->execute(array($idQuestion));

                //Loop through all related answers
                foreach ($answersToQuestions AS $nr => $answer) {

                    //Make sure the logged in user is not the same as the author of the answer
                    // Logged in user should not be able to mark his/her own answer as accepted
                    if($answer->author != $acronym) {

                        //Set all answers (belonging to question) to null, to avoid duplicate accepted answers
                        if (!is_null($answer->accepted)) {
                            $this->answers->save([
                                'id'    => $answer->id,
                                'accepted' => null,
                            ]);
                        }

                        //Mark chosen answer as accepted
                        if ($answer->id == $idAnswer) {
                            $this->answers->save([
                                'id'    => $answer->id,
                                'accepted' => $idQuestion,
                            ]);
                        }
                    }
                }

                //Redirect page back to question
                $url = $this->url->create('question/view/' . $idQuestion);
                $this->response->redirect($url);
            }
        }
    }

    /*
--------------------------------- COMMENTS -------------------------------
    */

    /**
     * Add a comment.
     *
     * @param integer $questionId which question comment belongs to
     * @param integer $answerId with id to answer (null if comment is to question and not an answer)
     *
     * @return void
     */
    public function commentAction($questionId = null, $answerId = null)
    {
        if (!isset($questionId)) {
            die("Missing id");
        }
        //Check if user is logged in
        $acronym = $this->session->has('user') ? $this->session->get('user') : null;

        //Set title
        $this->theme->setTitle('Lämna en kommentar');

        //If user is not logged in, show info message about logging in
        if (!$acronym) {
                $this->di->views->add('default/page', [
                'title' => "Lägg till kommentar",
                'content' => "Du måste vara inloggad för att kommentera"
            ]);
        } else {
            //If user is logged in, add comment to answer or question

            //Get information about the logged in user
            $userId = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($acronym));

            //Has an answer id been set?
            if (!$answerId) {
                //Show form to add comment to question
                $form = new \Anax\HTMLForm\CFormAddCommentQuestion($acronym, $questionId, null, $userId[0]->id);

            } else {
                //Show form to add comment to answer
                $form = new \Anax\HTMLForm\CFormAddCommentQuestion($acronym, $questionId, $answerId, $userId[0]->id);
            }
            $form->setDI($this->di);
            $form->check();

            //Get the question and answer the comment belongs to
            $commentToQuestion = $this->questions->find($questionId);
            $answerTo = $this->answers->find($answerId);

            //If question the comment belongs to was found in the database, add view to show data
            if (!empty($commentToQuestion)) {
                $this->di->views->add('questions/addComment', [
                    'content' => $form->getHTML(),
                    'answerToTitle' => $commentToQuestion->title,
                    'answerToQuestion' => $this->textFilter->doFilter($commentToQuestion->content, "markdown"),
                    'answerToAnswer'  => $answerTo,
                ]);
            } else {
                //If no comment was found, show info message
                $this->di->views->add('default/page', [
                    'title' => "Hoppsan",
                    'content' => "Hittar ingen kommentar med id:et."
                ]);
            }
        }
    }

    /**
     * View all comments.
     *
     * @param integer $questionId the id of question (if comment to question)
     * @param integer $answerId the of the answer (if comment to an answer)
     *
     * @return void
     */
    private function viewCommentsAction($questionId, $answerId)
    {
        $all = null;

        //Are the comments for question or answer?
        if ($questionId) {
            //Get comments for the question
            $all = $this->comments->query()
                ->where('questionId = ?')
                ->andWhere('answerId IS NULL')
                ->execute(array($questionId));

        } else if ($answerId) {
            //Get comments for the answer
            $all = $this->comments->query()
                ->where('answerId = ?')
                ->execute(array($answerId));
        }
        //Add to view
        $this->views->add('questions/comments', [
            'comments' => $all,
        ]);
    }

    /*
------------------------------ VOTING -------------------------------------
    */

    /**
    * Upvote or downvote on questions, comments and answers
    *
    * @param string $type if upvote or downvote
    * @param integer $idQ id to question
    * @param integer $idA id to answer (if an answer is upvoted)
    * @param integer $idC id to comment (if a comment is upvoted)
    *
    * @return void
    */
    private function votingAction($type, $idQ = null, $idA = null, $idC = null) {

        //is the user logged in?
        $acronym = $this->session->has('user') ? $this->session->get('user') : null;

        //If not logged in, show info message
        if(!$acronym) {
            $this->di->views->add('default/page', [
                'title' => "Inloggning krävs",
                'content' => "Du behöver vara inloggad för att göra detta"
            ]);

        //If logged in
        } else {

            //Get user details from database
            $userid = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($acronym));

            //If id to answer and comment is null, upvote/downvote a question
            if (is_null($idA) && is_null($idC)) {

                //Get question details from database
                $question = $this->questions->find($idQ);

                //If question was found in database
                if(!empty($question)) {

                    //Make sure the question author doesn't upvote/downvote his/her own question
                    if($question->author != $acronym) {

                        //Get question score and increment by 1 if upvote or decrease by 1 if downvote
                        $score = $type == 'upvote' ? $question->score + 1 : $question->score - 1;

                        //Check if it is a new vote or if the user has voted on the same question before
                        $votedBefore = $this->votes->query()
                            ->where('idUser = ?')
                            ->andWhere('idQuestion = ?')
                            ->execute(array($userid[0]->id, $question->id));

                        //If user has not voted on the question before, update the score in database
                        if (empty($votedBefore)) {

                            $this->votes->save([
                                'idUser' => $userid[0]->id,
                                'idQuestion' => $question->id,
                            ]);

                            $this->questions->update([
                                'id' => $question->id,
                                'score' => $score,
                            ]);
                        }
                    }
                }

            //If answer id is set, but not comment id, upvote/downvote an answer
            } else if (isset($idA) && is_null($idC)) {

                //Get answer from database
                $answer = $this->answers->find($idA);

                //If the answer was found
                if (!empty($answer)) {

                    //Get question score and increment by 1 if upvote or decrease by 1 if downvote
                    $score = $type == 'upvote' ? $answer->score + 1 : $answer->score - 1;

                    //Make sure the question author doesn't upvote/downvote his/her own answer
                    if ($answer->author != $acronym) {

                        //Check if it is a new vote or if the user has voted on the same answer before
                        $votedBefore = $this->votes->query()
                            ->where('idUser = ?')
                            ->andWhere('idAnswer = ?')
                            ->execute(array($userid[0]->id, $answer->id));

                        //If user has not voted on the answer before, update the score in database
                        if(empty($votedBefore)) {

                            $this->votes->save([
                                'idUser' => $userid[0]->id,
                                'idAnswer' => $answer->id
                            ]);

                            $this->answers->update([
                                'id' => $answer->id,
                                'score' => $score,
                            ]);
                        }
                    }
                }

            //If answer id and comment id is set, upvote/downvote a comment
            } else if (isset($idA) && isset($idC)) {

                //Get the comment from database
                $comment = $this->comments->find($idC);

                //If comment was found in dabase
                if(!empty($comment)) {

                    //Get question score and increment by 1 if upvote or decrease by 1 if downvote
                    $score = $type == 'upvote' ? $comment->score + 1 : $comment->score - 1;

                    //Make sure the user doesn't upvote/downvote his/her own comment
                    if($comment->author != $acronym) {

                        //Check if user has voted on the exact same comment before
                        $votedBefore = $this->votes->query()
                            ->where('idUser = ?')
                            ->andWhere('idComment = ?')
                            ->execute(array($userid[0]->id, $comment->id));

                        //Update the new score
                        if(empty($votedBefore)) {
                            $this->votes->save([
                                'idUser' => $userid[0]->id,
                                'idComment' => $comment->id
                            ]);

                            $this->comments->update([
                                'id' => $comment->id,
                                'score' => $score,
                            ]);
                        }
                    }
                }
            }

            //Redirect back to question
            $url = $this->url->create('question/view/' . $idQ);
            $this->response->redirect($url);
        }

    }


    /**
    * Upvote on questions, comments and answers
    *
    * @param integer $idQ id to question
    * @param integer $idA id to answer (if an answer is upvoted)
    * @param integer $idC id to comment (if a comment is upvoted)
    *
    * @return void
    */
    public function upvoteAction($idQ = null, $idA = null, $idC = null) {

        if(!isset($idQ)) {
            die("Missing question id.");
        }

        if (!is_numeric($idQ)) {
            die("id must be numeric");
        }

        return $this->votingAction('upvote', $idQ, $idA, $idC);

    }

    /**
    * Downvote on questions, comments and answers
    *
    * @param integer $idQ id to question
    * @param integer $idA id to answer (if an answer is downvoted)
    * @param integer $idC id to comment (if a comment is downvoted)
    *
    * @return void
    */
    public function downvoteAction($idQ = null, $idA = null, $idC = null) {

        if(!isset($idQ)) {
            die("Missing question id.");
        }

        if (!is_numeric($idQ)) {
            die("id must be numeric");
        }

        return $this->votingAction('downvote', $idQ, $idA, $idC);

    }

}
