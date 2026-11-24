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

use App\Support\SiteLanguage;
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
        $tickerFiles = Document::whereStatus(1)
            ->whereMarkAsNew(1)
            ->orderByBsPublishedDateDesc()
            ->limit(15)
            ->get();
        $sliders = Slider::latest()->get();

        // The homepage shows three categories, three documents per sub-category tab.
        // Load just those instead of every document in every category.
        $categories = DocumentCategory::with([
            'documentCategories' => function ($query) {
                $query->whereShowOnIndex(1)->orderBy('position');
            },
        ])
            ->whereShowOnIndex(1)
            ->whereNull('document_category_id')
            ->orderBy('position')
            ->limit(3)
            ->get();

        foreach ($categories as $category) {
            foreach ($category->documentCategories as $subcategory) {
                $subcategory->setRelation('documents', $subcategory->documents()
                    ->whereStatus(1)
                    ->orderByBsPublishedDateDesc()
                    ->limit(3)
                    ->get());
            }
        }

        $noticePopups = Document::with('files')->where('popUp', 1)->get();
        $galleries = PhotoGallery::with('coverPhoto')->whereHas('photos')->limit(3)->latest()->get();
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
        // A plain database query: Scout's builder can't use the BS date ordering scope,
        // and this way search doesn't depend on which Scout driver the server has set.
        $documents = Document::query()
            ->whereStatus(1)
            ->where(function ($query) use ($keyword) {
                foreach (['title', 'title_en', 'description', 'description_en', 'publisher', 'publisher_en'] as $column) {
                    $query->orWhere($column, 'like', '%' . $keyword . '%');
                }
            })
            ->with(['files', 'documentCategory', 'mainDocumentCategory'])
            ->orderByBsPublishedDateDesc()
            ->paginate(20)
            ->withQueryString();

        return view('frontend.search.search_res', compact('keyword', 'documents'));
    }

    public function faq()
    {
        $faqs = Faq::latest()->get();

        return view('frontend.faq', compact('faqs'));
    }

    public function officeDetails(OfficeDetail $officeDetail)
    {
        return view('frontend.officeDetail', compact('officeDetail'));
    }

    public function documentCategory(DocumentCategory $documentCategory)
    {
        $mainCategory = $documentCategory->parentCategory ?? $documentCategory;
        $documentCategory->load(['documentCategories' => fn ($query) => $query->orderBy('position')]);
        $keyword = trim((string) request('q'));

        // A sub-category lists its own documents; a main category lists everything filed under it.
        $relation = $documentCategory->documents()->whereStatus(1)->exists()
            ? $documentCategory->documents()
            : $documentCategory->mainDocuments();

        $documents = $relation
            ->with(['files', 'documentCategory'])
            ->whereStatus(1)
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    foreach (['title', 'title_en', 'publisher', 'publisher_en'] as $column) {
                        $query->orWhere($column, 'like', '%' . $keyword . '%');
                    }
                });
            })
            ->orderByBsPublishedDateDesc()
            ->paginate(25)
            ->withQueryString();

        return view('frontend.document.document', compact('documentCategory', 'mainCategory', 'documents', 'keyword'));
    }

    public function documentDetail(Document $document)
    {
        $document->load('files', 'mainDocumentCategory', 'documentCategory');

        $relatedDocuments = Document::with('mainDocumentCategory')->where('id', '!=', $document->id)
            ->whereStatus(1)
            ->where(function ($query) use ($document) {
                $query->where('document_category_id', $document->document_category_id);
                $query->where('main_document_category_id', $document->main_document_category_id);
            })
            ->orderByBsPublishedDateDesc()
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
                $photoAlbums = PhotoGallery::with('coverPhoto')->whereHas('photos')->latest()->get();
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



    public function languageChange(string $lang)
    {
        $lang = SiteLanguage::isSupported($lang) ? $lang : config('app.locale');
        session([SiteLanguage::SESSION_KEY => $lang]);

        // Back to the page the visitor was on, with ?language= swapped (keeping page=, q= etc.).
        $previous = parse_url(url()->previous());
        if (($previous['host'] ?? null) !== request()->getHost()) {
            return redirect()->route('welcome', ['language' => $lang]);
        }

        parse_str($previous['query'] ?? '', $query);
        $query['language'] = $lang;

        return redirect(url($previous['path'] ?? '/') . '?' . http_build_query($query));
    }


}
