<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.08.2018
 * Time: 15:28
 */

namespace App\Controller;

use App\Api\ActivityLogApiModel;
use App\Entity\ActivityLog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    /**
     * @param mixed $data Usually an object you want to serialize
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->get('serializer')->serialize($data, 'json');
        return new JsonResponse($json, $statusCode, [], true);
    }

    /**
     * Returns an associative array of validation errors
     *
     * {
     *     'firstName': 'This value is required',
     *     'subForm': {
     *         'someField': 'Invalid value'
     *     }
     * }
     *
     * @param FormInterface $form
     * @return array|string
     */
    protected function getErrorsFromForm(FormInterface $form)
    {
        // only supporting 1 error per field
        // and not supporting a "field" with errors, that has more
        // fields with errors below it
        foreach ($form->getErrors() as $error) {
            // only supporting 1 error per field
            // and not supporting a "field" with errors, that has more
            // fields with errors below it
            return $error->getMessage();
        }

        $errors = array();
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childError = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childError;
                }
            }
        }

        return $errors;
    }

    /**
     * Turns a RepLog into a RepLogApiModel for the API.
     *
     * This could be moved into a service if it needed to be
     * re-used elsewhere.
     *
     * @param RepLog $repLog
     * @return RepLogApiModel
     */
    protected function createActivityLogApiModel(ActivityLog $activityLog)
    {
        $model = new ActivityLogApiModel();
        $model->id  = $activityLog->getId();
        $model->log = $activityLog->getLog();

        $selfUrl = $this->generateUrl('activity_log_get', ['id' => $activityLog->getId()]);
        $model->addLink('_self', $selfUrl);

        return $model;
    }

    /**
     * @return ActivityLogApiModel[]
     */
    protected function findAllUsersActivityLogModels()
    {
        $activityLogs = $this->getDoctrine()->getRepository(ActivityLog::class)->findBy(array('user' => $this->getUser()));
        $models = [];
        foreach($activityLogs as $activityLog){
            $models[] = $this->createActivityLogApiModel($activityLog);
        }

        return $models;
    }
}