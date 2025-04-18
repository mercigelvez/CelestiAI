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
        $cardCount = match ($request->spread_type) {
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
        return view('readings.histories', compact('readings'));
    }

    /**
     * Get full tarot deck.
     */
    private function getTarotDeck()
    {
        // Base path for all tarot images
        $imagePath = 'images/tarot/';

        // Major Arcana - no changes needed
        $majorArcana = [
            ['name' => 'The Fool', 'image' => $imagePath . 'the-fool-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Magician', 'image' => $imagePath . 'the-magician-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The High Priestess', 'image' => $imagePath . 'the-high-priestess-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Empress', 'image' => $imagePath . 'the-empress-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Emperor', 'image' => $imagePath . 'the-emperor-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hierophant', 'image' => $imagePath . 'The-Hierophant-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Lovers', 'image' => $imagePath . 'The-Lovers-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Chariot', 'image' => $imagePath . 'The-Chariot-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Strength', 'image' => $imagePath . 'The-Strength-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hermit', 'image' => $imagePath . 'The-Hermit-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Wheel of Fortune', 'image' => $imagePath . 'The-Wheel-of-Fortune-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Justice', 'image' => $imagePath . 'The-Justice-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Hanged Man', 'image' => $imagePath . 'The-Hanged-Man-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Death', 'image' => $imagePath . 'The-Death-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Temperance', 'image' => $imagePath . 'The-Temperance-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Devil', 'image' => $imagePath . 'The-Devil-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Tower', 'image' => $imagePath . 'The-Tower-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Star', 'image' => $imagePath . 'The-Star-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Moon', 'image' => $imagePath . 'The-Moon-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The Sun', 'image' => $imagePath . 'The-Sun-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'Judgement', 'image' => $imagePath . 'The-Judgement-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
            ['name' => 'The World', 'image' => $imagePath . 'The-World-tarot-card.jpg', 'type' => 'major', 'orientation' => 'upright'],
        ];

        // Minor Arcana - updated to use hyphens instead of underscores
        $suits = ['Cups', 'Pentacles', 'Swords', 'Wands'];
        $cards = ['Ace', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Page', 'Knight', 'Queen', 'King'];
        $cardsNumeric = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Page', 'Knight', 'Queen', 'King'];

        $minorArcana = [];
        foreach ($suits as $index => $suit) {
            foreach ($cards as $cardIndex => $card) {
                $cardNumeric = $cardsNumeric[$cardIndex];
                $name = $cardNumeric . ' of ' . $suit;

                // Format image filename with hyphens instead of underscores to match your actual files
                $image = $imagePath . $card . '-of-' . $suit . '-tarot-card.jpg';

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
            // Format the cards and spread info for the system
            $cardsInfo = [];
            foreach ($cards as $index => $card) {
                $position = $this->getCardPosition($spreadType, $index);
                $cardsInfo[] = [
                    'position' => $position,
                    'card' => $card['name'],
                    'orientation' => $card['orientation']
                ];
            }

            // Set up the prompt for the knowledge system
            $prompt = "Generate a mystical and insightful tarot reading based on the following cards:\n\n";
            $prompt .= "Question: {$question}\n";
            $prompt .= "Spread Type: " . $this->formatSpreadType($spreadType) . "\n\n";

            foreach ($cardsInfo as $cardInfo) {
                $prompt .= "Position: {$cardInfo['position']}\n";
                $prompt .= "Card: {$cardInfo['card']} ({$cardInfo['orientation']})\n\n";
            }

            // Generate interpretation using knowledge base
            $interpretation = $this->generateKnowledgeBasedReading($prompt, $cards, $spreadType, $question);

            return $interpretation;

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Interpretation generation error: ' . $e->getMessage());
            // Fallback to a simple interpretation if knowledge system fails
            return $this->getFallbackInterpretation($cards, $spreadType, $question);
        }
    }

    /**
     * Generate a knowledge-based tarot interpretation.
     */
    private function generateKnowledgeBasedReading($prompt, $cards, $spreadType, $question)
    {
        // Extract card data (already available in the $cards parameter)

        // Start building the reading
        $reading = "**Mystical Tarot Reading**\n\n";

        // Add a personalized introduction based on the question
        $reading .= $this->getPersonalizedIntroduction($question, $spreadType) . "\n\n";

        // Add individual card interpretations
        foreach ($cards as $index => $card) {
            $position = $this->getCardPosition($spreadType, $index);
            $cardName = $card['name'];
            $orientation = $card['orientation'];

            $reading .= "**" . $position . ": " . $cardName . " (" . $orientation . ")**\n\n";
            $reading .= $this->getEnhancedCardMeaning($cardName, $orientation) . "\n\n";

            // Add position-specific insights
            $reading .= $this->getPositionInsight($position, $cardName, $orientation, $question) . "\n\n";
        }

        // Add card combinations analysis
        if (count($cards) > 1) {
            $reading .= "**Card Combinations and Patterns**\n\n";
            $reading .= $this->analyzeCardCombinations($cards, $spreadType, $question) . "\n\n";
        }

        // Add overall guidance
        $reading .= "**Overall Guidance**\n\n";
        $reading .= $this->generateOverallGuidance($cards, $spreadType, $question) . "\n\n";

        // Add a closing message
        $reading .= "Remember that tarot provides guidance, but you always hold the power to shape your own destiny. May this reading illuminate your path forward.";

        return $reading;
    }

    /**
     * Get a  meaning for a card.
     */
    private function getEnhancedCardMeaning($card, $orientation)
    {
        $meanings = [
            'The Fool' => [
                'upright' => 'New beginnings, innocence, and spontaneity are illuminating your path. This card suggests taking a leap of faith and embracing the unknown with an open heart.',
                'reversed' => 'Hesitation, recklessness, or missed opportunities may be affecting your journey. It might be time to reconsider how you approach risk and uncertainty.'
            ],
            'The Magician' => [
                'upright' => 'You possess all the tools needed to manifest your desires and transform your reality. Your skills and talents are aligning with your purpose.',
                'reversed' => 'Untapped potential or manipulation may be present in your situation. Consider if you are using your abilities to their fullest or if someone is being deceptive.'
            ],
            'The High Priestess' => [
                'upright' => 'Your intuition is powerful now. Hidden knowledge and mysteries are available to you if you turn inward and listen to your inner voice.',
                'reversed' => 'You may be ignoring your intuition or dealing with secrets that need to be revealed. Trust your deeper knowing.'
            ],
            'The Empress' => [
                'upright' => 'Abundance, nurturing, and fertility surround you. This is a time of growth, creativity, and connection with the natural world.',
                'reversed' => 'Creative blocks, dependency issues, or neglect of self-care may be present. Consider how you nurture yourself and others.'
            ],
            'The Emperor' => [
                'upright' => 'Structure, authority, and leadership are highlighted. You have the power to create order from chaos and establish stable foundations.',
                'reversed' => 'Excessive control, rigidity, or problems with authority figures may be challenging you. Balance is needed between structure and flexibility.'
            ],
            'The Hierophant' => [
                'upright' => 'Traditional wisdom, spiritual guidance, and established institutions are supporting you. Consider the value of conventional approaches.',
                'reversed' => 'Challenging conventions, seeking alternative spiritual paths, or feeling restricted by dogma may be part of your journey now.'
            ],
            'The Lovers' => [
                'upright' => 'Harmony, relationships, and important choices are emphasized. This card speaks of alignment with your values and heart-centered decisions.',
                'reversed' => 'Disharmony, imbalance in relationships, or avoidance of important choices may be creating tension in your life.'
            ],
            'The Chariot' => [
                'upright' => 'Determination, willpower, and victory through effort are indicated. You have the drive to overcome obstacles and move forward with confidence.',
                'reversed' => 'Lack of direction, aggression, or being overwhelmed by opposing forces may be slowing your progress.'
            ],
            'Strength' => [
                'upright' => 'Inner courage, patience, and gentle power are your allies now. Complex situations can be resolved through compassion rather than force.',
                'reversed' => 'Self-doubt, weakness, or raw emotion may be overwhelming your inner strength. Remember the power of soft persistence.'
            ],
            'The Hermit' => [
                'upright' => 'Soul-searching, introspection, and inner guidance are illuminating your path. This is a time for solitude and deep personal reflection.',
                'reversed' => 'Isolation, loneliness, or rejecting needed solitude may be creating imbalance. Consider your relationship with alone time.'
            ],
            'Wheel of Fortune' => [
                'upright' => 'Change, cycles, and destiny are at work in your life. What goes around comes around, and new opportunities are emerging through life natural rhythms.',
                'reversed' => 'Resistance to change, bad luck, or disrupted cycles may be creating challenges. Try to flow with life inevitable movements.'
            ],
            'Justice' => [
                'upright' => 'Fairness, truth, and cause and effect are highlighted. Legal matters may resolve favorably, and karma is active in your situation.',
                'reversed' => 'Unfairness, dishonesty, or lack of accountability may be present. Consider where balance needs to be restored.'
            ],
            'The Hanged Man' => [
                'upright' => 'Surrender, new perspectives, and enlightenment through pause are offered now. Sometimes non-action is the most powerful choice.',
                'reversed' => 'Resistance, stalling, or indecision may be preventing necessary sacrifice or shift in viewpoint.'
            ],
            'Death' => [
                'upright' => 'Transformation, endings, and new beginnings are occurring. This powerful card indicates that a phase is concluding to make way for renewal.',
                'reversed' => 'Resistance to necessary change, stagnation, or inability to move on may be blocking your growth and evolution.'
            ],
            'Temperance' => [
                'upright' => 'Balance, moderation, and patience are bringing harmony to your situation. Integration of opposing forces leads to healing.',
                'reversed' => 'Imbalance, excess, or lack of long-term perspective may be creating discord. Finding middle ground is essential.'
            ],
            'The Devil' => [
                'upright' => 'Bondage, materialism, and shadow aspects are revealed for examination. Awareness of what enslaves you is the first step to freedom.',
                'reversed' => 'Release from unhealthy attachments, exploring dark truths, or overcoming addiction may be part of your current process.'
            ],
            'The Tower' => [
                'upright' => 'Sudden change, revelation, and liberation through upheaval are indicated. What seems like destruction makes way for truth and rebuilding.',
                'reversed' => 'Avoiding necessary collapse, fear of change, or experiencing a less intense awakening may be affecting your situation.'
            ],
            'The Star' => [
                'upright' => 'Hope, inspiration, and spiritual connection bring healing after difficult times. This card offers serenity and promise for the future.',
                'reversed' => 'Discouragement, lack of faith, or disconnection from your spiritual center may be dimming your inner light.'
            ],
            'The Moon' => [
                'upright' => 'Intuition, unconscious patterns, and illusion invite you to explore what lies beneath the surface. Dreams and emotions hold important messages.',
                'reversed' => 'Confusion, repressed fears, or misinterpretation of intuitive signals may be creating uncertainty. Clarity is coming.'
            ],
            'The Sun' => [
                'upright' => 'Joy, success, and vitality shine upon you. This card brings clarity, warmth, and positive outcomes after any darkness.',
                'reversed' => 'Temporary setbacks, clouded joy, or excessive optimism without substance may be affecting your experience of happiness.'
            ],
            'Judgement' => [
                'upright' => 'Rebirth, inner calling, and absolution bring a powerful awakening. A higher purpose is calling you toward renewal and important realizations.',
                'reversed' => 'Self-doubt, refusing your calling, or inability to forgive yourself or others may be preventing spiritual progress.'
            ],
            'The World' => [
                'upright' => 'Completion, integration, and accomplishment mark the end of a significant cycle. Wholeness and fulfillment are available to you now.',
                'reversed' => 'Seeking closure, incomplete goals, or resistance to ending things properly may be delaying your sense of completion.'
            ],
            // Adding selected Minor Arcana
            'Ace of Cups' => [
                'upright' => 'New emotional beginnings, intuition, and love are flowing into your life. Your heart is opening to receive blessings.',
                'reversed' => 'Emotional blockage, spilled opportunities, or repressed feelings may be preventing the flow of love and compassion.'
            ],
            'Ten of Swords' => [
                'upright' => 'An ending, painful yet necessary, clears the way for renewal. Though difficult, this situation has reached its conclusion.',
                'reversed' => 'Recovery beginning, resistance to closure, or lingering pain may be prolonging what needs to end.'
            ],
            'Queen of Wands' => [
                'upright' => 'Courage, determination, and joy radiate from this card. Your confident self-expression and passionate energy attract success.',
                'reversed' => 'Self-doubt, jealousy, or suppressed creative fire may be diminishing your natural confidence and leadership.'
            ],
            'Knight of Pentacles' => [
                'upright' => 'Patience, reliability, and methodical progress characterize your approach. Steady effort leads to tangible results.',
                'reversed' => 'Stagnation, excessive caution, or feeling stuck in routines may be preventing necessary movement and growth.'
            ],
        ];

        // If we have a specific meaning for this card
        if (isset($meanings[$card][$orientation])) {
            return $meanings[$card][$orientation];
        }

        // If we don't have the specific card, try to match by partial name (for minor arcana)
        foreach ($meanings as $cardName => $orientations) {
            if (strpos($card, substr($cardName, 0, 5)) !== false) {
                return $orientations[$orientation];
            }
        }

        // Generic responses as fallback
        $upright_templates = [
            "This card brings positive energy of growth and expansion in your situation. The universe is supporting your endeavors with powerful, aligned energies.",
            "A harmonious force is guiding you toward your true purpose. This card suggests opportunities that align with your authentic self.",
            "The energies of this card indicate a favorable time for advancement and positive transformation in this aspect of your life."
        ];

        $reversed_templates = [
            "There may be obstacles or internal resistance blocking your progress. This suggests a need for reflection and recalibration.",
            "This suggests a need to reflect and overcome certain challenges before moving forward. Inner work is essential at this time.",
            "Internal work may be needed to balance the energies this card represents. Consider what might be out of alignment in this situation."
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
            'transformation',
            'spiritual growth',
            'inner wisdom',
            'divine timing',
            'emotional healing',
            'renewed purpose',
            'self-discovery',
            'cosmic alignment',
            'intuitive awakening',
            'soul purpose',
            'karmic balance',
            'sacred knowledge'
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
     * Get detailed theme for a card.
     */
    private function getCardTheme($cardName)
    {
        $themes = [
            // Major Arcana
            'The Fool' => 'embracing beginnings with trust and openness',
            'The Magician' => 'recognizing and utilizing your personal power and resources',
            'The High Priestess' => 'honoring your intuition and subconscious knowledge',
            'The Empress' => 'nurturing growth, abundance, and creative expression',
            'The Emperor' => 'establishing structure, stability, and healthy authority',
            'The Hierophant' => 'connecting with tradition, mentorship, and spiritual guidance',
            'The Lovers' => 'making heart-aligned choices and harmonizing relationships',
            'The Chariot' => 'directing your willpower and overcoming obstacles',
            'Strength' => 'applying gentle persistence and emotional courage',
            'The Hermit' => 'seeking wisdom through reflection and introspection',
            'Wheel of Fortune' => 'recognizing life natural cycles and embracing change',
            'Justice' => 'bringing balance, fairness, and clarity to situations',
            'The Hanged Man' => 'gaining fresh perspective through surrender and pause',
            'Death' => 'allowing transformation and releasing what no longer serves you',
            'Temperance' => 'finding balance, moderation, and patient integration',
            'The Devil' => 'examining attachments and freeing yourself from limitations',
            'The Tower' => 'experiencing breakthrough and necessary disruption',
            'The Star' => 'connecting with hope, inspiration, and spiritual renewal',
            'The Moon' => 'navigating the unknown and trusting your deeper intuition',
            'The Sun' => 'embracing clarity, joy, and authentic self-expression',
            'Judgement' => 'answering your calling and experiencing awakening',
            'The World' => 'achieving completion, integration, and wholeness',

            // Sample Minor Arcana
            'Ace of Cups' => 'opening to new emotional experiences and spiritual connections',
            'Ten of Swords' => 'accepting necessary endings and preparing for renewal',
            'Queen of Wands' => 'expressing yourself with confidence and passionate energy',
            'Knight of Pentacles' => 'taking methodical action and demonstrating reliability'
        ];

        return $themes[$cardName] ?? 'connecting with your authentic path and inner wisdom';
    }

    /**
     * Generate personalized introduction based on question and spread type.
     */
    private function getPersonalizedIntroduction($question, $spreadType)
    {
        $questionType = $this->categorizeQuestion($question);
        $spreadName = $this->formatSpreadType($spreadType);

        $intros = [
            'career' => "As you seek guidance regarding your professional path, the $spreadName spread reveals insights about your career journey and potential opportunities ahead.",
            'relationship' => "The cards have been drawn to illuminate your relationship questions. This $spreadName spread offers a window into the energies surrounding your connections with others.",
            'spiritual' => "Your spiritual inquiry has called forth these cards. The $spreadName spread presents a mystical mirror reflecting your inner journey and soul's purpose.",
            'decision' => "Standing at this crossroads, you've asked for guidance with an important choice. The $spreadName spread illuminates the energies influencing your decision.",
            'general' => "The universe responds to your inquiry through these cards. The $spreadName spread reveals the energies currently surrounding your path."
        ];

        return $intros[$questionType] ?? $intros['general'];
    }

    /**
     * Categorize the question type.
     */
    private function categorizeQuestion($question)
    {
        $question = strtolower($question);

        $keywords = [
            'career' => ['job', 'career', 'work', 'profession', 'business', 'employment', 'promotion'],
            'relationship' => ['love', 'relationship', 'partner', 'boyfriend', 'girlfriend', 'spouse', 'marriage', 'dating'],
            'spiritual' => ['spiritual', 'growth', 'purpose', 'soul', 'spirit', 'meditation', 'enlightenment', 'path'],
            'decision' => ['decision', 'choose', 'choice', 'option', 'path', 'direction', 'should i']
        ];

        foreach ($keywords as $type => $words) {
            foreach ($words as $word) {
                if (strpos($question, $word) !== false) {
                    return $type;
                }
            }
        }

        return 'general';
    }

    /**
     * Get position-specific insights.
     */
    private function getPositionInsight($position, $cardName, $orientation, $question)
    {
        // Position-specific insights for three-card spread
        $insights = [
            'Past' => [
                'upright' => "This card in the past position suggests foundational experiences that have shaped your current situation. Its energy continues to influence you today.",
                'reversed' => "This reversed card in the past position indicates unresolved issues or lessons that may still need integration before you can fully move forward."
            ],
            'Present' => [
                'upright' => "In your present position, this card highlights the key energies currently at work in your situation. Pay close attention to how it resonates with your daily experience.",
                'reversed' => "This reversed card in the present position reveals current challenges or blockages that require your awareness and attention."
            ],
            'Future' => [
                'upright' => "In the future position, this card shows potential outcomes if you continue on your current path. It offers a glimpse of emerging possibilities.",
                'reversed' => "This reversed card in the future position suggests upcoming challenges that may require preparation or a shift in approach."
            ],
            'Current Situation' => [
                'upright' => "This card perfectly captures the essence of your current circumstances. Its energy is actively present in your life right now.",
                'reversed' => "This reversed card reflects the complexities and challenges of your present situation, highlighting what may be out of balance."
            ]
        ];

        // Return specific insight if available
        if (isset($insights[$position][$orientation])) {
            return $insights[$position][$orientation];
        }

        // Generic insights as fallback
        $generic = [
            'upright' => "In this position, the card illuminates how " . strtolower(explode(' (', $cardName)[0]) . "'s energy influences this aspect of your question.",
            'reversed' => "In this position, the reversed " . strtolower(explode(' (', $cardName)[0]) . " suggests a need for attention to potential imbalances or hidden aspects."
        ];

        return $generic[$orientation];
    }

    //----METHODS--//

    /**
     * Analyze card combinations for deeper insights.
     */
    private function analyzeCardCombinations($cards, $spreadType, $question)
    {
        // Basic combination analysis
        $analysis = "Looking at these cards together reveals an interesting narrative. ";

        // Check for patterns
        $majorCount = 0;
        $suits = [];
        $reversedCount = 0;

        foreach ($cards as $card) {
            if (strpos($card['name'], 'The ') === 0 || in_array($card['name'], ['Strength', 'Justice', 'Death', 'Temperance', 'Judgement'])) {
                $majorCount++;
            } else {
                // Extract suit from minor arcana
                preg_match('/of (\w+)/', $card['name'], $matches);
                if (isset($matches[1])) {
                    $suits[$matches[1]] = isset($suits[$matches[1]]) ? $suits[$matches[1]] + 1 : 1;
                }
            }

            if ($card['orientation'] === 'reversed') {
                $reversedCount++;
            }
        }

        // Add insights based on patterns
        if ($majorCount > count($cards) / 2) {
            $analysis .= "The presence of multiple Major Arcana cards suggests that significant life events and spiritual lessons are prominent in your situation. These powerful archetypal energies indicate that larger forces are at work in your life. ";
        }

        // Check for suit patterns
        $dominantSuit = '';
        $maxCount = 0;
        foreach ($suits as $suit => $count) {
            if ($count > $maxCount) {
                $maxCount = $count;
                $dominantSuit = $suit;
            }
        }

        if ($maxCount > 1 && $dominantSuit) {
            $suitMeanings = [
                'Cups' => "emotions, relationships, and intuition are central themes",
                'Pentacles' => "material concerns, work, and physical well-being are highlighted",
                'Swords' => "mental processes, decisions, and communication are key factors",
                'Wands' => "creativity, passion, and spiritual growth are driving forces"
            ];

            $analysis .= "The prevalence of " . $dominantSuit . " suggests that " . $suitMeanings[$dominantSuit] . " in your situation. ";
        }

        // Check balance of reversed cards
        if ($reversedCount > count($cards) / 2) {
            $analysis .= "With several cards appearing reversed, there may be delays, internal work, or hidden aspects that need attention before you can move forward clearly.";
        } elseif ($reversedCount == 0) {
            $analysis .= "With all cards appearing upright, there's a sense of flowing energy and forward movement in this situation.";
        }

        return $analysis;
    }

    /**
     * Generate overall guidance based on the reading.
     */
    private function generateOverallGuidance($cards, $spreadType, $question)
    {
        $questionType = $this->categorizeQuestion($question);

        // Extract key cards for focus (first and last cards often carry special significance)
        $firstCard = $cards[0];
        $lastCard = $cards[count($cards) - 1];

        // Base guidance on question type and key cards
        $guidance = "";

        switch ($questionType) {
            case 'career':
                $guidance = "In your professional journey, the " . $firstCard['name'] . " suggests that " .
                    $this->getCardTheme($firstCard['name']) . " is particularly significant. As you move forward, keep in mind that " .
                    $this->getActionableAdvice($lastCard['name'], $lastCard['orientation']) . " This reading indicates that your career path is influenced by both internal attitudes and external circumstances.";
                break;

            case 'relationship':
                $guidance = "In matters of the heart, " . $firstCard['name'] . " reveals that " .
                    $this->getCardTheme($firstCard['name']) . " is playing a key role. The relationship energy is moving toward " .
                    $this->getCardTheme($lastCard['name']) . ". Consider how " .
                    $this->getActionableAdvice($firstCard['name'], $firstCard['orientation']) . " to nurture meaningful connections.";
                break;

            default:
                $guidance = "As you navigate this situation, the essence of " . $firstCard['name'] . " reminds you that " .
                    $this->getCardTheme($firstCard['name']) . " is central to your experience now. Moving forward, " .
                    $this->getActionableAdvice($lastCard['name'], $lastCard['orientation']) . " Trust that the universe is supporting your highest good, even when the path isn't entirely clear.";
        }

        return $guidance;
    }

    /**
     * Get actionable advice based on a card.
     */
    private function getActionableAdvice($cardName, $orientation)
    {
        $advice = [
            'The Fool' => [
                'upright' => "embrace new beginnings with trust and openness",
                'reversed' => "carefully evaluate risks before leaping into the unknown"
            ],
            'The Magician' => [
                'upright' => "harness your existing skills and resources to manifest your desires",
                'reversed' => "be honest about what tools you truly possess and avoid shortcuts"
            ],
            'Strength' => [
                'upright' => "approach challenges with gentle persistence rather than force",
                'reversed' => "work on building your inner confidence and patience"
            ],
            'The Star' => [
                'upright' => "maintain hope and trust in the unfolding of your path",
                'reversed' => "reconnect with your sense of purpose and optimism"
            ]
        ];

        // Return specific advice if available
        if (isset($advice[$cardName][$orientation])) {
            return $advice[$cardName][$orientation];
        }

        // Generic advice based on orientation
        return $orientation === 'upright'
            ? "focus on the positive energies of growth and alignment in your journey"
            : "address any resistances or blockages that may be hindering your progress";
    }
}
