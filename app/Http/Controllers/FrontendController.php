<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleCollection\StoreSampleCollectionRequest;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\Bill;
use App\Models\ContactMessage;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Employee;
use App\Models\ExEmployee;
use App\Models\FamilyMember;
use App\Models\Faq;
use App\Models\Link;
use App\Models\OfficeDetail;
use App\Models\Pedigree;
use App\Models\PedigreeCaste;
use App\Models\PedigreeCategory;
use App\Models\PhotoGallery;
use App\Models\SampleCollection;
use App\Models\Slider;
use App\Models\Smuggling;
use App\Models\SpermDistribution;
use App\Models\SubDivision\SubDivision;
use App\Models\SubDivision\SubDivisionDocument;
use App\Models\SubDivision\SubDivisionEmployee;
use App\Models\VideoGallery;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class FrontendController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $officeDetail = OfficeDetail::whereShowOnIndex(1)->whereType('Introduction')->first();
        $tickerFiles = Document::whereMarkAsNew(1)->orderBy('published_date')->get();
        $sliders = Slider::latest()->get();
        $categories = DocumentCategory::with([
            'documentCategories' => function ($query) {
                $query->whereShowOnIndex(1)->orderBy('position');
            },
            'documentCategories.documents' => function ($query) {
                $query->whereStatus(1)->orderByDesc('published_date');
            },
            'mainDocuments' => function ($query) {
                $query->whereStatus(1)->orderByDesc('published_date');
            }
        ])
            ->whereShowOnIndex(1)
            ->whereNull('document_category_id')
            ->orderBy('position')
            ->get();
        $noticePopups = Document::with('files')->where('popUp', 1)->get();
        $galleries = PhotoGallery::with('photos')->whereHas('photos')->limit(3)->latest()->get();
        return view('frontend.index', compact('officeDetail', 'tickerFiles', 'sliders', 'categories', 'galleries', 'noticePopups'));
        if (config('default.subDivision')) {
            $subDivisions = SubDivision::latest()->get();
            $compact[] = 'subDivisions';
        }
        return view('frontend.index', compact($compact));
    }


    public function search()
    {
        $keyword = request('keyword');
        if (empty($keyword)) {
            return back();
        }
        $documents = Document::search($keyword)->paginate(20);

        return view('frontend.search.search_res', compact('keyword', 'documents'));
    }

    public function officeDetails(OfficeDetail $officeDetail)
    {
        return view('frontend.officeDetail', compact('officeDetail'));
    }

    public function documentCategory(DocumentCategory $documentCategory)
    {

        $mainCategory = $documentCategory->parentCategory ?? $documentCategory;

        $documentCategory->load([
            'mainDocuments' => function ($query) {
                $query->with('mainDocumentCategory')->whereStatus(1)->orderByDesc('published_date');
            },
            'documents' => function ($query) {
                $query->with('documentCategory')->whereStatus(1)->orderByDesc('published_date');
            }
        ]);

        return view('frontend.document.document', compact('documentCategory', 'mainCategory'));
    }

    public function documentDetail(Document $document)
    {
        $document->load('files');

        $relatedDocuments = Document::with('mainDocumentCategory')->where('id', '!=', $document->id)
            ->where(function ($query) use ($document) {
                $query->where('document_category_id', $document->document_category_id);
                $query->where('main_document_category_id', $document->main_document_category_id);
            })
            ->orderByDesc('published_date')
            ->limit(5)
            ->get();

        return view('frontend.document.document_detail', compact('document', 'relatedDocuments'));
    }

    public function staticMenus($slug)
    {
        switch ($slug) {

            case 'contactUs':
                return view('frontend.contact');
                break;
            case 'photoGallery':
                $photoAlbums = PhotoGallery::with('photos')->latest()->get();
                return view('frontend.gallery.gallery', compact('photoAlbums'));
                break;

            case 'videoGallery':
                $videoGalleries = VideoGallery::latest()->get();
                return view('frontend.gallery.video', compact('videoGalleries'));
            case 'employees':
                $employees = Employee::with('designation', 'department')->orderBy('position')->get();
                return view('frontend.employee', compact('employees'));
            case 'bill':
                $bills = Bill::orderByDesc('bill_date')->get();
                return view('frontend.bill', compact('bills'));
            case 'subDivision':
                $subDivisions = SubDivision::get();
                return view('frontend.sub-division.index', compact('subDivisions'));
            case 'faq':
                $faqs = Faq::latest()->get();
                return view('frontend.faq', compact('faqs'));
            case 'links':
                $importantLinks = Link::latest()->get();
                return view('frontend.links', compact('importantLinks'));
            case 'allExEmployee':
                $exEmployees = ExEmployee::orderBy('leaving_date', 'asc')->get();
            case 'exEmployee':
                $exEmployees = ExEmployee::where('is_chief', 0)->orderBy('leaving_date', 'asc')->get();
                return view('frontend.allExEmployee', compact('exEmployees'));

            case 'exChief':
                $exEmployees = ExEmployee::where('is_chief', 1)->orderBy('leaving_date', 'asc')->get();
                return view('frontend.allExEmployee', compact('exEmployees'));

            case 'smuggling':
                $smugglings = Smuggling::whereNull('sub_division_id')->latest()->get();
                return view('frontend.smuggling.index', compact('smugglings'));
            default:
                return response(view('errors.404'), 404);
        }
    }

    public function subDivisionDetail(SubDivision $subDivision)
    {
        $subDivisionChief = SubDivisionEmployee::where('sub_division_id', $subDivision->id)->whereIsChief(1)->first();

        return view('frontend.sub-division.detail', compact('subDivision', 'subDivisionChief'));
    }

    public function subDivisionStaffs(SubDivision $subDivision)
    {
        $subDivisionChief = SubDivisionEmployee::where('sub_division_id', $subDivision->id)->whereIsChief(1)->first();
        $subDivision->load(['subDivisionEmployee' => function ($query) {
            $query->whereIsChief(0);
        }]);

        return view('frontend.sub-division.staff', compact('subDivision', 'subDivisionChief'));
    }

    public function smugglingDetail(Smuggling $smuggling)
    {
        $smuggling->load('files');
        $relatedSmugglings = Smuggling::whereNull('sub_division_id')->where('id', '!=', $smuggling->id)->latest()->limit(5)->get();

        return view('frontend.smuggling.detail', compact('smuggling', 'relatedSmugglings'));
    }

    public function subDivisionDocuments(SubDivision $subDivision)
    {
        $subDivision->load('subDivisionDocuments.files', 'subDivisionDocuments.subDivisionDocumentCategory');

        return view('frontend.sub-division.docs', compact('subDivision'));
    }

    public function subDivisionDocumentDetail(SubDivision $subDivision, SubDivisionDocument $subDivisionDocument)
    {
        $subDivisionDocument->load('files');
        $subDivisionDocuments = SubDivisionDocument::where('sub_division_id', $subDivision->id)->where('id', '!=', $subDivisionDocument->id)->orderByDesc('date')->limit(5)->get();

        return view('frontend.sub-division.document_detail', compact('subDivision', 'subDivisionDocument', 'subDivisionDocuments'));
    }

    public function subDivisionSmuggling(SubDivision $subDivision)
    {
        $subDivision->load('smugglings.files');

        return view('frontend.sub-division.smuggling.index', compact('subDivision'));
    }

    public function subDivisionSmugglingDetail(SubDivision $subDivision, Smuggling $smuggling)
    {
        $smuggling->load('files');
        $relatedSmugglings = Smuggling::where('sub_division_id', $subDivision->id)->where('id', '!=', $smuggling->id)->latest()->limit(5)->get();

        return view('frontend.sub-division.smuggling.detail', compact('subDivision', 'smuggling', 'relatedSmugglings'));
    }

    public function photoGalleryDetails(PhotoGallery $photoGallery)
    {
        $photoGallery->load('photos');

        return view('frontend.gallery.photo', compact('photoGallery'));
    }

    public function sendMessage(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('message', "Message Sent Successfully");
    }



    public function languageChange($lang)
    {

        if (config('default.dual_language')) {
            if (!empty($lang) && in_array($lang, config('app.locales'))) {
                Cache::put('language', $lang, 60 * 60 * 12);
                app()->setLocale($lang);
            } else {
                Cache::put('language', 'ne', 60 * 60 * 12);
                app()->setLocale('ne');
            }
        }
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        if ($route == 'welcome') {
            return redirect(\route($route, ['language' => $lang]));
        } else {
            $count = Str::length($url);

            $url = Str::substr($url, 0, $count - 2);
            return redirect($url . $lang ?? 'ne');
        }
    }


}
