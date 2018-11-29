USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 29/11/2018 6:45:46 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [varchar](30) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Usage_Stat] [int] NOT NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Category_Serials_Program]    Script Date: 29/11/2018 6:45:46 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category_Serials_Program](
	[CategoryID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[ProgramID] [varchar](50) NOT NULL,
	[NumberofItemsReceived_Prog] [int] NOT NULL,
 CONSTRAINT [PK_Category_Serials_Program] PRIMARY KEY CLUSTERED 
(
	[CategoryID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 29/11/2018 6:45:46 PM ******/
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
/****** Object:  Table [dbo].[Delivery_Subs]    Script Date: 29/11/2018 6:45:46 PM ******/
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
/****** Object:  Table [dbo].[Department]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[Distributor]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[Organization]    Script Date: 29/11/2018 6:45:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Organization](
	[OrganizationID] [varchar](50) NOT NULL,
	[DepartmentID] [varchar](30) NOT NULL,
 CONSTRAINT [PK_Organization] PRIMARY KEY CLUSTERED 
(
	[OrganizationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Program]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[ReceiveSerial_Program]    Script Date: 29/11/2018 6:45:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial_Program](
	[ReceiveSerialID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[ProgramID] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give_Prog] [date] NOT NULL,
 CONSTRAINT [PK_ReceiveSerial_Program] PRIMARY KEY CLUSTERED 
(
	[ReceiveSerialID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[Subscription]    Script Date: 29/11/2018 6:45:47 PM ******/
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
/****** Object:  Table [dbo].[User]    Script Date: 29/11/2018 6:45:47 PM ******/
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

INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'College', 4308, 2367, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'College', 4309, 2368, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'ELEM', 4309, 2369, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'College', 4310, 2371, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'JHS', 4308, 2373, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'JHS', 4304, 2385, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'College', 4304, 2386, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'ELEM', 4304, 2387, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'JHS', 4310, 2388, 0, 0)
SET IDENTITY_INSERT [dbo].[Categorize_Serials] OFF
SET IDENTITY_INSERT [dbo].[Category_Serials_Program] ON 

INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (104, 4308, N'Accountancy', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (105, 4308, N'BUSS AD', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (110, 4309, N'BSEE', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (111, 4309, N'IT', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (118, 4304, N'CS', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (119, 4304, N'IT', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (121, 4310, N'BSECE', 0)
INSERT [dbo].[Category_Serials_Program] ([CategoryID_Program], [SubscriptionID], [ProgramID], [NumberofItemsReceived_Prog]) VALUES (122, 4310, N'BSEE', 0)
SET IDENTITY_INSERT [dbo].[Category_Serials_Program] OFF
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (143, CAST(N'2018-11-08' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1143, CAST(N'2018-11-11' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1144, CAST(N'2018-11-12' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1145, CAST(N'2018-11-22' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1146, CAST(N'2018-11-29' AS Date))
SET IDENTITY_INSERT [dbo].[Delivery] OFF
SET IDENTITY_INSERT [dbo].[Delivery_Subs] ON 

INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (1, 1146, 4304, CAST(N'2018-11-30' AS Date), NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (2, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (3, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (4, 1146, 4304, NULL, NULL, N'3', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (5, 1146, 4304, CAST(N'2018-11-30' AS Date), NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (6, 1146, 4304, NULL, NULL, N'2', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (7, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (8, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (9, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (10, 1146, 4304, NULL, NULL, N'2', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (11, 1146, 4304, NULL, NULL, N'4', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (12, 1146, 4304, NULL, NULL, N'3', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (13, 1146, 4304, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (14, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (15, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (16, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (17, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (18, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (19, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (20, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (21, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (22, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (23, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (24, 1146, 4304, NULL, NULL, N'3', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (25, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (26, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (27, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (28, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (29, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (30, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (31, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (32, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (33, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (34, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (35, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (36, 1146, 4304, NULL, N'3', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (37, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (38, 1146, 4304, NULL, NULL, N'5', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (39, 1146, 4304, NULL, NULL, N'5', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (40, 1146, 4304, NULL, NULL, N'5', NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (41, 1146, 4304, NULL, N'4', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (42, 1146, 4310, NULL, N'6', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (43, 1146, 4304, NULL, N'6', NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber], [Remove], [Remove_Remarks]) VALUES (44, 1146, 4310, NULL, N'6', NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Delivery_Subs] OFF
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'College', NULL, NULL)
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'ELEM', NULL, NULL)
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'JHS', NULL, NULL)
INSERT [dbo].[Department] ([DepartmentID], [Remove], [Remove_Remarks]) VALUES (N'SHS', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (1, N'HAJIE', N'HajieNigger', N'12312315', N'hajienigger@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (2, N'Emerald', N'Daniel', N'666666666', N'tabbu@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (3, N'FJM', N'Kyle', N'09061254785', N'era@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (4, N'UMX', N'Vince', N'096587414650', N'malano@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (5, N'Agdamag', N'Carl', N'095632541125', N'sagisi@yahoo.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (18, N'Try', N'Try2', N'0935556684', N'asd@gmail.com', NULL, NULL)
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Remove], [Remove_Remarks]) VALUES (1031, N'dsadasd', N'dsadas', N'1313231232', N'NA@gmail.com', N'Removed', N'asdsadasdas')
SET IDENTITY_INSERT [dbo].[Distributor] OFF
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SBAA', N'College')
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SEAFA', N'College')
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SEAS', N'College')
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SHAS', N'College')
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SHVED', N'College')
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID]) VALUES (N'SICS', N'College')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N' PolScie', N'SEAS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'AB Legma', N'SEAS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'Accountancy', N'SBAA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSCE', N'SEAFA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSCIE', N'SICS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSECE', N'SEAFA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSEE', N'SEAFA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSGE', N'SEAFA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSMT', N'SHAS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSN', N'SHAS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BSPhar', N'SHAS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'BUSS AD', N'SBAA')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'CS', N'SICS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'HRM', N'SHVED')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'HTM', N'SHVED')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'IT', N'SICS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID]) VALUES (N'Teacher Ed', N'SEAS')
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2143, N'College', 2, N'NotReceived', CAST(N'2018-11-29' AS Date), NULL, NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2144, N'ELEM', 2, N'NotReceived', CAST(N'2018-11-29' AS Date), NULL, NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2145, N'College', 4, N'NotReceived', CAST(N'2018-11-29' AS Date), NULL, NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment], [Remove], [Remove_Remarks]) VALUES (2146, N'JHS', 4, N'NotReceived', CAST(N'2018-11-29' AS Date), NULL, NULL, NULL, NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial_Program] ON 

INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog]) VALUES (19, 2, N'CS', CAST(N'2018-11-29' AS Date))
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog]) VALUES (20, 2, N'IT', CAST(N'2018-11-29' AS Date))
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog]) VALUES (21, 4, N'BSECE', CAST(N'2018-11-29' AS Date))
INSERT [dbo].[ReceiveSerial_Program] ([ReceiveSerialID_Program], [SerialID], [ProgramID], [DateReceiveNotif_Give_Prog]) VALUES (22, 4, N'BSEE', CAST(N'2018-11-29' AS Date))
SET IDENTITY_INSERT [dbo].[ReceiveSerial_Program] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (2, N'Journal', N'DUMMY', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (3, N'Magazine', N'Catholic Historical Review', N'International', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (4, N'Magazine', N'Disney Princess', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (5, N'Journal', N'Journal of Abnormal Psychology (APA)', N'International', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (6, N'Magazine', N'Adventure Box', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (8, N'Journal', N'Adventure Box2', N'International', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (25, N'Magazine', N'new', N'International', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (35, N'Journal', N'new ser', N'Local', NULL, NULL)
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin], [Remove], [Remove_Remarks]) VALUES (37, N'Journal', N'asdasd', N'Local', N'Removed', N'asdasdas')
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4304, 1, 2, 2, N'OnGoing', NULL, N'Complete', CAST(N'2019-03-29' AS Date), CAST(N'2018-11-29' AS Date), CAST(N'2018-11-30' AS Date), 2, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4308, 4, 6, 6, N'OnGoing', NULL, N'Phase1', CAST(N'2019-03-29' AS Date), CAST(N'2018-11-29' AS Date), CAST(N'2018-11-30' AS Date), 5, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4309, 4, 8, 6, N'OnGoing', NULL, N'Phase1', CAST(N'2019-05-20' AS Date), CAST(N'2018-11-20' AS Date), CAST(N'2018-11-30' AS Date), 5, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency], [Remove], [Remove_Remarks]) VALUES (4310, 4, 4, 4, N'OnGoing', NULL, N'Complete', CAST(N'2019-03-21' AS Date), CAST(N'2018-11-21' AS Date), CAST(N'2018-11-30' AS Date), 5, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (179, N'NewAcc', N'7815696ecbf1c96e6894b779456d330e', N'New', N'Account', N'ELEM_christaa.jpg', N'NA@gmail.com', N'Staff', NULL, NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (182, N'akumao', N'21232f297a57a5a743894a0e4a801fc3', N'Aku', N'Mao', N'COLLEGE_609282.jpg', N'akumao@gmail.com', N'Admin', NULL, NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (183, N'dsadas', N'c91c03ea6c46a86cbc019be3d71d0a1a', N'dsadas', N'dsadsa', N'asd.png', N'asd@gmail.com', N'Admin', NULL, N'Removed', N'kick out
')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (184, N'dsaasd', N'7815696ecbf1c96e6894b779456d330e', N'dsadas', N'dsa', N'new_christaa.jpg', N'NA@gmail.com', N'Staff', NULL, N'Removed', N'quitted')
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
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
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
