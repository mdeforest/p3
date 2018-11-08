<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ResumeController extends Controller
{
    public function index(Request $request)
    {
        return view('resume.index');
    }

    public function createResume(Request $request)
    {
        $request->validate([
            'template' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'jobTitle' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'nullable|email',
            'phoneNumber' => 'nullable|digits:10',
            'website' => 'nullable|url',
            'summary' => 'required',
            'additionalInfo' => 'required',
            'output' => 'required',
            'experience.jobTitle.*' => 'sometimes|required',
            'experience.company.*' => 'sometimes|required',
            'experience.location.*' => 'sometimes|required',
            'experience.fromMonth.*' => 'sometimes|required',
            'experience.fromYear.*' => 'sometimes|required',
            'experience.toMonth.*' => 'sometimes|required',
            'experience.toYear.*' => 'sometimes|required',
            'experience.html-content.*' => 'required',
            'education.degree.*' => 'sometimes|required',
            'education.where.*' => 'sometimes|required',
            'education.location.*' => 'sometimes|required',
            'education.fromYear.*' => 'sometimes|required',
            'education.toYear.*' => 'sometimes|required',
            'education.html-content.*' => 'sometimes|required'
        ]);

        // Set variables from $request
        // education and experience are different like before

        $template = $request->input('template');
        $output = $request->input('output');

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $jobTitle = $request->input('jobTitle');
        $city = $request->input('city');
        $state = $request->input('state');
        $email = $request->input('email', '');
        $phoneNumber = $request->input('phoneNumber', '');
        $website = $request->input('website', '');
        $summary = $request->input('summary');
        $additionalInfo = $request->input('additionalInfo');

        $experience = [];
        $education = [];

        if ($request->has('experience')) {
            for ($i = 0; $i < count($request->input('experience.jobTitle')); $i++) {
                array_push($experience, []);
                $experience[$i]['jobTitle'] = $request->input('experience.jobTitle.' . $i);
                $experience[$i]['company'] = $request->input('experience.company.' . $i);
                $experience[$i]['location'] = $request->input('experience.location.' . $i);
                $experience[$i]['fromMonth'] = $request->input('experience.fromMonth.' . $i);
                $experience[$i]['fromYear'] = $request->input('experience.fromYear.' . $i);
                $experience[$i]['toMonth'] = $request->input('experience.toMonth.' . $i);
                $experience[$i]['toYear'] = $request->input('experience.toYear.' . $i);
                $experience[$i]['html-content'] = $request->input('experience.html-content.' . $i);
            }
        }

        if ($request->has('education')) {
            for ($i = 0; $i < count($request->input('education.degree')); $i++) {
                array_push($education, []);
                $education[$i]['degree'] = $request->input('education.degree.' . $i);
                $education[$i]['where'] = $request->input('education.where.' . $i);
                $education[$i]['location'] = $request->input('education.location.' . $i);
                $education[$i]['fromYear'] = $request->input('education.fromYear.' . $i);
                $education[$i]['toYear'] = $request->input('education.toYear.' . $i);
                $education[$i]['html-content'] = $request->input('education.html-content.' . $i);
            }
        }

        // Set fields in _SESSION

        $request->session()->put('template', $template);
        $request->session()->put('output', $output);
        $request->session()->put('experience', $experience);
        $request->session()->put('education', $education);

        $request->session()->put('results', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'jobTitle' => $jobTitle,
            'city' => $city,
            'state' => $state,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'website' => $website,
            'summary' => $summary,
            'additionalInfo' => $additionalInfo
        ]);


        // Redirect to done page where resume will be displayed
        return redirect('resume');
    }

    public function displayResume(Request $request)
    {
        // Return to index if the template, results, our output are not set in _SESSION
        if (!$request->session()->has('template') | !$request->session()->has('results') | !$request->session()->has('output')) {
            header('Location: index.php');
        }

        // Necessary to make experience or education an empty list instead of unset
        $experience = $request->session()->get('experience', []);
        $education = $request->session()->get('education', []);


        $results = $request->session()->get('results');
        $output = $request->session()->get('output');

        // Fill out template using XPath notation
        $doc = new \DOMDocument();
        $doc->loadHTMLFile('templates/' . $request->session()->get("template") . '/' . $request->session()->get('template') . '.html');

        $xpath = new \DOMXPath($doc);

        foreach ($results as $key => $value) {
            $query = "//*[contains(concat(' ',normalize-space(@class),' '),' " . $key . " ') and not(ancestor-or-self::*[@data-category='experience']) and not(ancestor-or-self::*[@data-category='education'])]";
            $node = $xpath->query($query);

            foreach ($node as $item) {
                $item->nodeValue = htmlentities($value, ENT_QUOTES, "utf-8");
            }
        }

        if (count($experience) == 0) {
            $query = "//div[@data-category='experience']";
            $node = $xpath->query($query);

            foreach ($node as $item) {
                $oldNode = $item->parentNode->removeChild($item);
            }
        } else {
            for ($i = 0; $i < count($experience); $i++) {
                foreach ($experience[$i] as $key => $value) {
                    $query = "(//div[@data-category='experience']//div//div//*[contains(concat(' ',normalize-space(@class),' '), ' " . $key . " ')])[last()]";
                    $node = $xpath->query($query);
                    $node[0]->nodeValue = htmlentities($value, ENT_QUOTES, "utf-8");
                }

                $query = "(//div[@data-category='experience']//div//div[@data-category='experience'])[last()]";
                $node = $xpath->query($query);

                if ($i < count($experience) - 1) {
                    $duplicate = $node->item(0)->cloneNode(true);
                    $node->item(0)->parentNode->appendChild($duplicate);
                } else {
                    $node->item(0)->attributes->item(0)->nodeValue = "last-child";
                }
            }
        }

        if (count($education) == 0) {
            $query = "//div[@data-category='education']";
            $node = $xpath->query($query);

            foreach ($node as $item) {
                $oldNode = $item->parentNode->removeChild($item);
            }
        } else {
            for ($i = 0; $i < count($education); $i++) {
                foreach ($education[$i] as $key => $value) {
                    $query = "(//div[@data-category='education']//div//div//*[contains(concat(' ',normalize-space(@class),' '), ' " . $key . " ')])[last()]";
                    $node = $xpath->query($query);
                    $node[0]->nodeValue = htmlentities($value, ENT_QUOTES, "utf-8");
                }

                $query = "(//div[@data-category='education']//div//div[@data-category='education'])[last()]";
                $node = $xpath->query($query);

                if ($i < count($education) - 1) {
                    $duplicate = $node->item(0)->cloneNode(true);
                    $node->item(0)->parentNode->appendChild($duplicate);
                } else {
                    $node->item(0)->attributes->item(0)->nodeValue = "last-child";
                }
            }
        }

        $htmlString = $doc->saveHTML();

        // Display pdf if pdf option chosen
        if ($output == 'pdf') {
            $filename = strtolower($results['firstName']) . '-' . strtolower($results['lastName']) . '-resume.pdf';

            $domPdf = new Dompdf();
            $domPdf->loadHtml($htmlString);
            $domPdf->render();
            $domPdf->stream($filename, ["Attachment" => false]);

            $request->session()->flush();
            exit();
        }

        return view('resume.display')->with('resume', $htmlString);
    }
}
