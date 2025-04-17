<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $readings = Auth::user()->readings()->latest()->paginate(10);
        return view('readings.index', compact('readings'));
    }

    /**
     * Show the form for creating a new reading.
     */
    public function create(Request $request)
    {
        $spreadType = $request->query('spread', 'single');

        // Define available spreads
        $spreads = [
            'single' => [
                'name' => 'Single Card',
                'description' => 'A simple one-card draw for quick guidance',
                'positions' => 1
            ],
            'three-card' => [
                'name' => 'Past-Present-Future',
                'description' => 'Three cards representing your journey through time',
                'positions' => 3
            ],
            'celtic-cross' => [
                'name' => 'Celtic Cross',
                'description' => 'A comprehensive 10-card spread for deep insight',
                'positions' => 10
            ],
            'relationship' => [
                'name' => 'Relationship Reading',
                'description' => 'Six cards exploring the dynamics of a relationship',
                'positions' => 6
            ],
            'career' => [
                'name' => 'Career Path',
                'description' => 'Five cards illuminating your professional journey',
                'positions' => 5
            ],
        ];

        return view('readings.create', compact('spreadType', 'spreads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'spread_type' => 'required|string',
            'question' => 'nullable|string|max:255',
        ]);

        // Determine number of cards based on spread type
        $cardCount = match($request->spread_type) {
            'single' => 1,
            'three-card' => 3,
            'celtic-cross' => 10,
            'relationship' => 6,
            'career' => 5,
            default => 3,
        };

        // Generate random cards
        $allCards = $this->getTarotDeck();
        $drawnCards = $this->drawRandomCards($allCards, $cardCount);

        // Generate interpretation based on cards and question
        $interpretation = $this->generateInterpretation(
            $drawnCards,
            $request->spread_type,
            $request->question ?? 'General Reading'
        );

        // Create the reading
        $reading = Auth::user()->readings()->create([
            'spread_type' => $request->spread_type,
            'question' => $request->question,
            'cards' => json_encode($drawnCards),
            'interpretation' => $interpretation,
        ]);

        return redirect()->route('readings.show', $reading)
            ->with('success', 'Your reading has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reading $reading)
    {
        // Ensure user can only view their own readings
        if ($reading->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cards = json_decode($reading->cards, true);

        return view('readings.show', compact('reading', 'cards'));
    }

    /**
     * Display the user's reading history.
     */
    public function history()
    {
        $readings = Auth::user()->readings()->latest()->paginate(15);
        return view('readings.history', compact('readings'));
    }

    /**
     * Get full tarot deck.
     */
    private function getTarotDeck()
    {
        // Major Arcana
        $majorArcana = [
            ['name' => 'The Fool', 'image' => 'fool.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Magician', 'image' => 'magician.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The High Priestess', 'image' => 'high_priestess.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Empress', 'image' => 'empress.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Emperor', 'image' => 'emperor.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hierophant', 'image' => 'hierophant.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Lovers', 'image' => 'lovers.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Chariot', 'image' => 'chariot.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Strength', 'image' => 'strength.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hermit', 'image' => 'hermit.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Wheel of Fortune', 'image' => 'wheel_of_fortune.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Justice', 'image' => 'justice.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hanged Man', 'image' => 'hanged_man.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Death', 'image' => 'death.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Temperance', 'image' => 'temperance.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Devil', 'image' => 'devil.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Tower', 'image' => 'tower.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Star', 'image' => 'star.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Moon', 'image' => 'moon.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Sun', 'image' => 'sun.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Judgement', 'image' => 'judgement.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The World', 'image' => 'world.jpg', 'type' => 'major', 'orientation' => 'upright'],
        ];

        // Minor Arcana
        $suits = ['cups', 'pentacles', 'swords', 'wands'];
        $cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Page', 'Knight', 'Queen', 'King'];

        $minorArcana = [];
        foreach ($suits as $suit) {
            foreach ($cards as $card) {
                $name = $card . ' of ' . ucfirst($suit);
                $image = strtolower($card) . '_of_' . $suit . '.jpg';
                $minorArcana[] = ['name' => $name, 'image' => $image, 'type' => 'minor', 'orientation' => 'upright'];
            }
        }

        return array_merge($majorArcana, $minorArcana);
    }

    /**
     * Draw random cards from the deck.
     */
    private function drawRandomCards($deck, $count)
    {
        $drawnCards = [];
        $indices = array_rand($deck, $count);

        if (!is_array($indices)) {
            $indices = [$indices];
        }

        foreach ($indices as $index) {
            $card = $deck[$index];
            // Randomly determine if card is reversed (50% chance)
            $card['orientation'] = rand(0, 1) ? 'upright' : 'reversed';
            $drawnCards[] = $card;
        }

        return $drawnCards;
    }

    /**
     * Generate an AI interpretation based on the cards drawn.
     */
    private function generateInterpretation($cards, $spreadType, $question)
    {
        try {
            // Format the cards and spread info for the AI
            $cardsInfo = [];
            foreach ($cards as $index => $card) {
                $position = $this->getCardPosition($spreadType, $index);
                $cardsInfo[] = [
                    'position' => $position,
                    'card' => $card['name'],
                    'orientation' => $card['orientation']
                ];
            }

            // Set up the prompt for the AI
            $prompt = "Generate a mystical and insightful tarot reading based on the following cards:\n\n";
            $prompt .= "Question: {$question}\n";
            $prompt .= "Spread Type: " . $this->formatSpreadType($spreadType) . "\n\n";

            foreach ($cardsInfo as $cardInfo) {
                $prompt .= "Position: {$cardInfo['position']}\n";
                $prompt .= "Card: {$cardInfo['card']} ({$cardInfo['orientation']})\n\n";
            }

            $prompt .= "Provide an overall interpretation that connects the cards' meanings and addresses the question. Include both practical advice and spiritual insights. Make it feel personal and mystical.";

            // Call your AI service here (this is a simplified example)
            // You would replace this with your actual AI integration
            $aiResponse = $this->callAiService($prompt);

            return $aiResponse;

        } catch (\Exception $e) {
            // Fallback to a template interpretation if AI fails
            return $this->getFallbackInterpretation($cards, $spreadType, $question);
        }
    }

    /**
     * Call AI service for interpretation.
     */
    private function callAiService($prompt)
    {
        // This is where you would integrate with your AI service
        // For example, using OpenAI's API:

        try {
            // Replace with your actual AI integration
            // Example using Laravel's HTTP client with OpenAI (you'd need API keys configured)
            /*
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 1000,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                return $response->json()['choices'][0]['text'];
            }
            */

            // For now, return a simulated response
            return $this->simulateAiResponse($prompt);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('AI service error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Simulate AI response for testing purposes.
     */
    private function simulateAiResponse($prompt)
    {
        // Extract card names from prompt for basic simulation
        preg_match_all('/Card: (.*?) \((upright|reversed)\)/', $prompt, $matches);
        $cards = $matches[1] ?? [];
        $orientations = $matches[2] ?? [];

        // Extract question
        preg_match('/Question: (.*?)\n/', $prompt, $questionMatch);
        $question = $questionMatch[1] ?? 'your journey';

        // Basic template response
        $response = "**Mystical Tarot Reading**\n\n";
        $response .= "The cosmic energies have aligned to provide insight into {$question}.\n\n";

        // Add interpretation for each card
        foreach ($cards as $index => $card) {
            $orientation = $orientations[$index] ?? 'upright';
            $response .= "**" . $card . "** (" . $orientation . "):\n";

            // Basic meaning based on card name and orientation
            $response .= $this->getBasicCardMeaning($card, $orientation) . "\n\n";
        }

        // Conclusion
        $response .= "**Overall Guidance:**\n";
        $response .= "The cards reveal a path of " . $this->getRandomTheme() . " for you. Trust your intuition as you navigate through " . $this->getRandomTheme() . " and " . $this->getRandomTheme() . ". The universe supports your journey toward " . $this->getRandomTheme() . ".\n\n";
        $response .= "Remember that you have the power to shape your destiny, and these cards are merely guides on your spiritual path.";

        return $response;
    }

    /**
     * Get a basic meaning for a card.
     */
    private function getBasicCardMeaning($card, $orientation)
    {
        $meanings = [
            'The Fool' => [
                'upright' => 'New beginnings, innocence, and spontaneity are illuminating your path.',
                'reversed' => 'Hesitation, recklessness, or missed opportunities may be affecting your journey.'
            ],
            'The Magician' => [
                'upright' => 'You possess all the tools needed to manifest your desires and transform your reality.',
                'reversed' => 'Untapped potential or manipulation may be present in your situation.'
            ],
            // Add more cards as needed
        ];

        // Return specific meaning if available, otherwise generic
        if (isset($meanings[$card][$orientation])) {
            return $meanings[$card][$orientation];
        }

        // Generic responses
        $upright_templates = [
            "This card brings positive energy of growth and expansion in your situation.",
            "The universe is supporting your endeavors with powerful, aligned energies.",
            "A harmonious force is guiding you toward your true purpose."
        ];

        $reversed_templates = [
            "There may be obstacles or internal resistance blocking your progress.",
            "This suggests a need to reflect and overcome certain challenges before moving forward.",
            "Internal work may be needed to balance the energies this card represents."
        ];

        $templates = $orientation === 'upright' ? $upright_templates : $reversed_templates;
        return $templates[array_rand($templates)];
    }

    /**
     * Get random spiritual theme.
     */
    private function getRandomTheme()
    {
        $themes = [
            'transformation', 'spiritual growth', 'inner wisdom', 'divine timing',
            'emotional healing', 'renewed purpose', 'self-discovery', 'cosmic alignment',
            'intuitive awakening', 'soul purpose', 'karmic balance', 'sacred knowledge'
        ];

        return $themes[array_rand($themes)];
    }

    /**
     * Fallback interpretation if AI fails.
     */
    private function getFallbackInterpretation($cards, $spreadType, $question)
    {
        $interpretation = "**Your Mystical Tarot Reading**\n\n";
        $interpretation .= "Seeking insight into: *" . e($question) . "*\n\n";

        foreach ($cards as $index => $card) {
            $position = $this->getCardPosition($spreadType, $index);
            $orientation = $card['orientation'];

            $interpretation .= "**" . e($position) . "**: " . e($card['name']) . " (" . e($orientation) . ")\n";
            $interpretation .= "This card suggests " . ($orientation === 'upright' ? 'positive' : 'challenging') . " energy related to " . $this->getCardTheme($card['name']) . ".\n\n";
        }

        $interpretation .= "**Overall Guidance**\n";
        $interpretation .= "The cards indicate a time of significant " . $this->getRandomTheme() . " in your life. Pay attention to signs and synchronicities that guide you toward your highest path.";

        return $interpretation;
    }

    /**
     * Get position description based on spread type and index.
     */
    private function getCardPosition($spreadType, $index)
    {
        $positions = [
            'single' => [
                0 => 'Current Situation'
            ],
            'three-card' => [
                0 => 'Past',
                1 => 'Present',
                2 => 'Future'
            ],
            'celtic-cross' => [
                0 => 'Present',
                1 => 'Challenge',
                2 => 'Past',
                3 => 'Future',
                4 => 'Above (Conscious)',
                5 => 'Below (Subconscious)',
                6 => 'Advice',
                7 => 'External Influences',
                8 => 'Hopes or Fears',
                9 => 'Outcome'
            ],
            'relationship' => [
                0 => 'You',
                1 => 'Partner',
                2 => 'Relationship Foundation',
                3 => 'Past Influence',
                4 => 'Current Dynamic',
                5 => 'Potential Future'
            ],
            'career' => [
                0 => 'Current Situation',
                1 => 'Challenges',
                2 => 'Strengths',
                3 => 'Action to Take',
                4 => 'Outcome'
            ],
        ];

        return $positions[$spreadType][$index] ?? "Position " . ($index + 1);
    }

    /**
     * Format spread type for display.
     */
    private function formatSpreadType($type)
    {
        $formats = [
            'single' => 'Single Card',
            'three-card' => 'Past-Present-Future',
            'celtic-cross' => 'Celtic Cross',
            'relationship' => 'Relationship Reading',
            'career' => 'Career Path'
        ];

        return $formats[$type] ?? ucfirst(str_replace('-', ' ', $type));
    }

    /**
     * Get theme for a card.
     */
    private function getCardTheme($cardName)
    {
        $themes = [
            'The Fool' => 'new beginnings and taking leaps of faith',
            'The Magician' => 'manifestation and utilizing your personal power',
            // You can add more specific themes for each card
        ];

        return $themes[$cardName] ?? 'your personal journey and spiritual growth';
    }
}
