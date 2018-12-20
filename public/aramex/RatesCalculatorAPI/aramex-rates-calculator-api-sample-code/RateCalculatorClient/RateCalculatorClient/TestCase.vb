Imports RateCalculatorClient.RateCalcService

Public Class TestCase

#Region "Members"
    Private _ID As Integer = 0
    Private _Text As String = String.Empty
    Private _Description As String = String.Empty
    Private _RateRequest As RateCalculatorRequest = Nothing
    Private _RateResponse As RateCalculatorResponse = Nothing
#End Region

#Region "Properties"
    Public Property ID As Integer
        Get
            Return _ID
        End Get
        Set(ByVal value As Integer)
            _ID = value
        End Set
    End Property

    Public Property Text As String
        Get
            Return _Text
        End Get
        Set(ByVal value As String)
            _Text = value
        End Set
    End Property

    Public Property Description As String
        Get
            Return _Description
        End Get
        Set(ByVal value As String)
            _Description = value
        End Set
    End Property

    Public Property RateRequest As RateCalculatorRequest
        Get
            Return _RateRequest
        End Get
        Set(ByVal value As RateCalculatorRequest)
            _RateRequest = value
        End Set
    End Property

    Public Property RateResponse As RateCalculatorResponse
        Get
            Return _RateResponse
        End Get
        Set(ByVal value As RateCalculatorResponse)
            _RateResponse = value
        End Set
    End Property
#End Region

#Region "Constructors"
    Public Sub New(ByVal ID As Integer, _
                   ByVal Text As String, _
                   ByVal Description As String, _
                   ByVal RateRequest As RateCalculatorRequest, _
                   ByVal RateResponse As RateCalculatorResponse)
        _ID = ID
        _Text = Text
        _Description = Description
        _RateRequest = RateRequest
        _RateResponse = RateResponse
    End Sub
#End Region

End Class
