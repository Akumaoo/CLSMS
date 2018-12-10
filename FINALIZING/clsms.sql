USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [varchar](30) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Usage_Stat_Employee] [int] NOT NULL,
	[Usage_Stat_Student] [int] NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Category_Serials_Program]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category_Serials_Program](
	[CategoryID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[ProgramID] [varchar](50) NOT NULL,
	[NumberofItemsReceived_Prog] [int] NOT NULL,
	[Usage_Stat_Employee_Prog] [int] NULL,
	[Usage_Stat_Student_Prog] [int] NULL,
 CONSTRAINT [PK_Category_Serials_Program] PRIMARY KEY CLUSTERED 
(
	[CategoryID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[Receive_Date] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery_Subs]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery_Subs](
	[DS_ID] [int] IDENTITY(1,1) NOT NULL,
	[DeliveryID] [int] NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Delivery_Subs] PRIMARY KEY CLUSTERED 
(
	[DS_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [varchar](30) NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distributor](
	[DistributorID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorName] [varchar](50) NOT NULL,
	[NameOfIncharge] [varchar](50) NOT NULL,
	[ContactNumber] [varchar](25) NOT NULL,
	[Email] [varchar](50) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Organization]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Organization](
	[OrganizationID] [varchar](50) NOT NULL,
	[DepartmentID] [varchar](30) NOT NULL,
	[Remove_org] [varchar](10) NULL,
	[Remove_Remarks_org] [varchar](50) NULL,
 CONSTRAINT [PK_Organization] PRIMARY KEY CLUSTERED 
(
	[OrganizationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Program]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Program](
	[ProgramID] [varchar](50) NOT NULL,
	[OrganizationID] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Program] PRIMARY KEY CLUSTERED 
(
	[ProgramID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](30) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [date] NOT NULL,
	[DateReceiveNotif_Receive] [date] NULL,
	[ControlNumber] [varchar](50) NULL,
	[Admin_Seen] [varchar](7) NULL,
	[Staff_Seen] [varchar](7) NULL,
	[Staff_Comment] [varchar](100) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial_Program]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial_Program](
	[ReceiveSerialID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[ProgramID] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give_Prog] [date] NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
	[DateReceiveNotif_Receive_Prog] [date] NULL,
	[Status_Prog] [varchar](50) NOT NULL,
	[ControlNumber_Prog] [varchar](50) NULL,
	[Staff_Comment_Prog] [varchar](100) NULL,
 CONSTRAINT [PK_ReceiveSerial_Program] PRIMARY KEY CLUSTERED 
(
	[ReceiveSerialID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](30) NULL,
	[SerialName] [varchar](50) NOT NULL,
	[Origin] [varchar](20) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Cost] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[Archive] [varchar](50) NULL,
	[IDD_Phase] [varchar](10) NULL,
	[InitialDeliveryDate] [date] NULL,
	[Subscription_Date] [date] NULL,
	[Subscription_End_Date] [date] NULL,
	[Frequency] [int] NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 10/12/2018 2:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[User](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[FirstName] [varchar](50) NOT NULL,
	[LastName] [varchar](50) NOT NULL,
	[Avatar] [varchar](50) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
	[DepartmentID] [varchar](30) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Categorize_Serials] ON 

INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'College', 4328, 2457, 2, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'ELEM', 4328, 2458, 2, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'College', 4329, 2459, 2, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'ELEM', 4329, 2460, 2, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'ELEM', 4330, 2461, 2, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat_Employee], [Usage_Stat_Student]) VALUES (N'College', 4330, 2462, 2, 0, 0)
SET IDENTITY_INSERT [dbo].[Categorize_Serials] OFF
SET IDENTITY_INSERT [dbo].[Category_Serials_Program] ON 

INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog], [Usage_Stat_Employee_Prog], [Usage_Stat_Student_Prog]) VALUES (214, 4328, N'BSCS', 2, 1, 1)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog], [Usage_Stat_Employee_Prog], [Usage_Stat_Student_Prog]) VALUES (215, 4329, N'BSIT', 2, 1, 1)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog], [Usage_Stat_Employee_Prog], [Usage_Stat_Student_Prog]) VALUES (216, 4330, N'BSCS', 1, 0, 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog], [Usage_Stat_Employee_Prog], [Usage_Stat_Student_Prog]) VALUES (217, 4330, N'BSIT', 1, 0, 0)
SET IDENTITY_INSERT [dbo].[Category_Serials_Program] OFF
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1158, CAST(N'2018-12-07' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1159, CAST(N'2018-12-08' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1160, CAST(N'2018-12-09' AS Date))
SET IDENTITY_INSERT [dbo].[Delivery] OFF
SET IDENTITY_INSERT [dbo].[Delivery_Subs] ON 

INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (160, 1158, 4328, CAST(N'2018-12-07' AS Date), N'1', N'1', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (161, 1158, 4329, CAST(N'2018-12-07' AS Date), N'1', N'1', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (164, 1159, 4328, CAST(N'2018-12-08' AS Date), N'2', N'2', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (165, 1159, 4329, CAST(N'2018-12-08' AS Date), N'2', N'2', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (168, 1159, 4330, NULL, NULL, N'1', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (169, 1160, 4330, NULL, N'1', NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Delivery_Subs] OFF
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'College', NULL, NULL)
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'ELEM', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (1032, N'hajie', N'hajie', N'123', N'hajie@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (1033, N'emerald', N'asdas', N'2313', N'col@gmail.com', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Distributor] OFF
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID], [Remove_org], [Remove_Remarks_org]) VALUES (N'asd', N'College', NULL, NULL)
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID], [Remove_org], [Remove_Remarks_org]) VALUES (N'SICS', N'College', NULL, NULL)
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'bc', N'asd')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSCS', N'SICS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSIT', N'SICS')
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2239, N'College', 38, N'Received', CAST(N'2018-12-07' AS Date), CAST(N'2018-12-07' AS Date), NULL, N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2240, N'ELEM', 38, N'Received', CAST(N'2018-12-07' AS Date), CAST(N'2018-12-07' AS Date), N'1', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2241, N'College', 39, N'Received', CAST(N'2018-12-07' AS Date), CAST(N'2018-12-07' AS Date), NULL, N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2242, N'ELEM', 39, N'Received', CAST(N'2018-12-07' AS Date), CAST(N'2018-12-07' AS Date), N'1', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2243, N'ELEM', 38, N'Received', CAST(N'2018-12-08' AS Date), CAST(N'2018-12-08' AS Date), N'55', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2244, N'ELEM', 39, N'Received', CAST(N'2018-12-08' AS Date), CAST(N'2018-12-08' AS Date), N'44', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2245, N'College', 38, N'Received', CAST(N'2018-12-08' AS Date), CAST(N'2018-12-08' AS Date), NULL, N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2246, N'College', 39, N'Received', CAST(N'2018-12-08' AS Date), CAST(N'2018-12-08' AS Date), NULL, N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2247, N'ELEM', 43, N'Received', CAST(N'2018-12-08' AS Date), CAST(N'2018-12-08' AS Date), N'3123', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2248, N'ELEM', 43, N'Received', CAST(N'2018-12-09' AS Date), CAST(N'2018-12-09' AS Date), N'3123131', N'Seen', N'Seen', N'Received', NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2249, N'College', 43, N'Received', CAST(N'2018-12-09' AS Date), CAST(N'2018-12-09' AS Date), NULL, N'Seen', N'Seen', N'Received', NULL, NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial_Program] ON 

INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (93, 38, N'BSCS', CAST(N'2018-12-07' AS Date), NULL, NULL, CAST(N'2018-12-07' AS Date), N'Received', N'1', N'Received')
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (94, 39, N'BSIT', CAST(N'2018-12-07' AS Date), NULL, NULL, CAST(N'2018-12-07' AS Date), N'Received', N'1', N'Received')
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (95, 38, N'BSCS', CAST(N'2018-12-08' AS Date), NULL, NULL, CAST(N'2018-12-08' AS Date), N'Received', N'23123231', N'Received')
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (96, 39, N'BSIT', CAST(N'2018-12-08' AS Date), NULL, NULL, CAST(N'2018-12-08' AS Date), N'Received', N'123123312', N'Received')
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (97, 43, N'BSCS', CAST(N'2018-12-09' AS Date), NULL, NULL, CAST(N'2018-12-09' AS Date), N'Received', N'312213123', N'Received')
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog], [Remove], [Remove_Remarks], [DateReceiveNotif_Receive_Prog], [Status_Prog], [ControlNumber_Prog], [Staff_Comment_Prog]) VALUES (98, 43, N'BSIT', CAST(N'2018-12-09' AS Date), NULL, NULL, CAST(N'2018-12-09' AS Date), N'Received', N'12312312312', N'Received')
SET IDENTITY_INSERT [dbo].[ReceiveSerial_Program] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (38, N'Magazine', N'Adventure Box', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (39, N'Journal', N'test', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (40, N'Journal', N'asd', N'Local', N'Removed', N're')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (41, N'Journal', N'test2', N'Local', N'Removed', N'dsa')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (42, N'Journal', N'test3', N'Local', N'Removed', N'asd')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (43, N'Journal', N'new', N'Local', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4328, 1033, 38, 2000, N'Finished', NULL, N'Complete', CAST(N'2019-04-07' AS Date), CAST(N'2018-12-07' AS Date), CAST(N'2018-12-07' AS Date), 2, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4329, 1032, 39, 1, N'Finished', NULL, N'Complete', CAST(N'2019-04-07' AS Date), CAST(N'2018-12-07' AS Date), CAST(N'2018-12-17' AS Date), 2, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4330, 1033, 43, 2, N'OnGoing', NULL, N'Complete', CAST(N'2019-04-08' AS Date), CAST(N'2018-12-08' AS Date), CAST(N'2018-12-29' AS Date), 2, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (179, N'NewAcc', N'7815696ecbf1c96e6894b779456d330e', N'New', N'Account', N'ELEM_christaa.jpg', N'NA@gmail.com', N'Staff', N'ELEM', NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (182, N'akumao', N'21232f297a57a5a743894a0e4a801fc3', N'Aku', N'Mao', N'COLLEGE_609282.jpg', N'akumao@gmail.com', N'Admin', N'College', NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (183, N'dsadas', N'c91c03ea6c46a86cbc019be3d71d0a1a', N'dsadas', N'dsadsa', N'asd.png', N'asd@gmail.com', N'Admin', NULL, N'Removed', N'kick out
')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (184, N'dsaasd', N'7815696ecbf1c96e6894b779456d330e', N'dsadas', N'dsa', N'new_christaa.jpg', N'NA@gmail.com', N'Staff', NULL, N'Removed', N'quitted')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (185, N'col', N'5f039b4ef0058a1d652f13d612375a5b', N'Coll', N'c', N'College_asd.png', N'col@gmail.com', N'Staff', N'College', NULL, NULL)
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Department]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Subscription]
GO
ALTER TABLE [dbo].[Category_Serials_Program]  WITH CHECK ADD  CONSTRAINT [FK_Category_Serials_Program_Program] FOREIGN KEY([ProgramID])
REFERENCES [dbo].[Program] ([ProgramID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Category_Serials_Program] CHECK CONSTRAINT [FK_Category_Serials_Program_Program]
GO
ALTER TABLE [dbo].[Category_Serials_Program]  WITH CHECK ADD  CONSTRAINT [FK_Category_Serials_Program_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Category_Serials_Program] CHECK CONSTRAINT [FK_Category_Serials_Program_Subscription]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Delivery] FOREIGN KEY([DeliveryID])
REFERENCES [dbo].[Delivery] ([DeliveryID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Delivery]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Subscription]
GO
ALTER TABLE [dbo].[Organization]  WITH CHECK ADD  CONSTRAINT [FK_Organization_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Organization] CHECK CONSTRAINT [FK_Organization_Department]
GO
ALTER TABLE [dbo].[Program]  WITH CHECK ADD  CONSTRAINT [FK_Program_Organization] FOREIGN KEY([OrganizationID])
REFERENCES [dbo].[Organization] ([OrganizationID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Program] CHECK CONSTRAINT [FK_Program_Organization]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Department]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Serial]
GO
ALTER TABLE [dbo].[ReceiveSerial_Program]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Program_Program] FOREIGN KEY([ProgramID])
REFERENCES [dbo].[Program] ([ProgramID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial_Program] CHECK CONSTRAINT [FK_ReceiveSerial_Program_Program]
GO
ALTER TABLE [dbo].[ReceiveSerial_Program]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Program_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial_Program] CHECK CONSTRAINT [FK_ReceiveSerial_Program_Serial]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
ALTER TABLE [dbo].[User]  WITH CHECK ADD  CONSTRAINT [FK_User_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
