<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

class RequirementsChecker
{

    /**
     * Check for the server requirements.
     *
     * @param array $requirements
     * @return array
     */
    public function check(array $requirements)
    {
        $results = [];

        foreach($requirements['php'] as $requirement)
        {
            $results['requirements'][$requirement] = true;

            if(!extension_loaded($requirement))
            {
                $results['requirements'][$requirement] = false;

                $results['errors'] = true;
            }

            if(!empty($requirements['apache']))
            {
                foreach ($requirements['apache'] as $requirement) {
                    if(function_exists('apache_get_modules'))
                    {
                        if(!in_array($requirement,apache_get_modules()))
                        {
                            $results['requirements'][$requirement] = true;
                        }
                    }
                }
            }

        }

        return $results;
    }
}